<?php
/**
 * Freshbooks Source
 * DataSource for the Freshbooks API
 *
 * Copyright (C) 2010 Kyle Robinson Young
 *
 * Permission is hereby granted, free of charge, to any person
 * obtaining a copy of this software and associated documentation
 * files (the "Software"), to deal in the Software without
 * restriction, including without limitation the rights to use,
 * copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the
 * Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be
 * included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
 * NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 *
 * @author Kyle Robinson Young <kyle at kyletyoung.com>
 * @copyright 2010 Kyle Robinson Young
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
 * @version 0.2
 *
 * TODO:
 * 	OAuth Support
 *
 */
class FreshbooksSource extends DataSource {

/**
 * description
 * @var string
 */
	public $description = 'Freshbooks DataSource';

/**
 * config
 * @var array
 */
	public $config = array(
		'subdomain' => '',
		'token' => '',
		/**
		 * cache
		 * true = use freshbooks cache
		 * false = disable cache
		 * 'cache-name' = cache config to use
		 */
		'cache' => true,
	);

/**
 * http
 * @var object
 */
	public $http = null;

/**
 * url
 * @var string
 */
	public $url = null;

/**
 * __requestXml
 * Stores the last sent xml string
 * @var string
 */
	private $__requestXml = null;

/**
 * __responseXml
 * Stores the last received xml string
 * @var string
 */
	private $__responseXml = null;

/**
 * __construct
 * @param array $config
 */
	public function __construct($config) {
		$this->init($config);
		parent::__construct($config);
	}

/**
 * init
 * Inits the socket, url and cache.
 *
 * @param array $config
 * @return bool
 */
	public function init($config=null) {
		$this->config = array_merge($this->config, (array)$config);
		if (!class_exists('HttpSocket') || !class_exists('Xml')) {
			App::import('Core', array('HttpSocket', 'Xml'));
		}
		$this->http = new HttpSocket();
		$this->url = 'https://'.$this->config['subdomain'].'.freshbooks.com/api/2.1/xml-in';
		if ($this->config['cache'] === true) {
			Cache::config('freshbooks', array('engine'=> 'File', 'prefix' => 'freshbooks_'));
			$this->config['cache'] = 'freshbooks';
		}
		return true;
	}

/**
 * read
 * Handles list and get sub methods.
 *
 * @access public
 * @param object $model
 * @param array $data
 * @return array
 */
	public function read(&$model, $data=array()) {
		$method = (isset($model->method)) ? $model->method : Inflector::underscore($model->alias);
		$params = array();
		if (isset($data['conditions'][$model->alias.'.'.$model->primaryKey])) {
			$model->id = $data['conditions'][$model->alias.'.'.$model->primaryKey];
		}
		if (isset($data['conditions'][$model->primaryKey])) {
			$model->id = $data['conditions'][$model->primaryKey];
		}
		if ($model->id !== false) {
			$submethod = 'get';
			$params[$model->primaryKey] = $model->id;
		} else {
			$submethod = 'list';
			$params['per_page'] = (!empty($data['limit'])) ? $data['limit'] : 100;
			$params['page'] = (!empty($data['page'])) ? $data['page'] : 1;
			$params = Set::merge((array)$data['conditions'], $params);
		}
		$hash = $method.'_'.$submethod.'_'.implode('_', array_merge(array_keys($params), array_values($params)));
		$hash = hash('md4', $hash);
		if (($res = Cache::read($hash, $this->config['cache'])) === false || $this->config['cache'] === false) {
			$params = array_map(create_function('$a', 'return array($a);'), $params);
			$xml =& new Xml(array('Request' => array('method' => $method.'.'.$submethod)+$params));
			$this->__requestXml = $xml->toString(array('header' => true));
			$res = $this->_parseResponse(
				$this->http->get($this->url, null, array_merge(
					$this->__getAuthArray(),
					array('body' => $this->__requestXml)
				)
			));
			if ($this->config['cache'] !== false) {
				if (isset($model->cache)) {
					Cache::set($model->cache);
				}
				Cache::write($hash, $res, $this->config['cache']);
			}
		}
		if ($res === false) {
			return array();
		}
		$findTable = Inflector::camelize($model->useTable);
		$findAlias = $model->alias;
		if ($data['fields'] == 'count') {
			if ($submethod == 'get') {
				$res = array(array(array('count' => 1)));
			} else {
				$res = array(array(array('count' => current(Set::extract('/Response/'.$findTable.'/total', $res)))));
			}
		} elseif ($submethod == 'get') {
			$this->_formatResponse($res);
			$res = array(array($model->alias => current(Set::extract('/Response/'.$findAlias.'/.', $res))));
		} else {
			$this->_formatResponse($res, 3);
			// MEH, ALMOST A HACKLESS DATASOURCE
			if ($model->alias == 'Staff') {
				$res = Set::extract('/Response/'.$findTable.'/Member', $res, array('flatten' => false));
				foreach ($res as $key => $val) {
					$res[$key]['Staff'] = $val['Member'];
					unset($res[$key]['Member']);
				}
			} else {
				$res = Set::extract('/Response/'.$findTable.'/'.$findAlias, $res, array('flatten' => false));
			}
		}
		return $res;
	}

/**
 * query
 * Give outside access to things in datasource.
 *
 * @param string $query
 * @param array $data
 * @param object $model
 * @return mixed
 */
	public function query($query=null, $data=null, &$model=null) {
		if (strpos(strtolower($query), 'findby') === 0) {
			$field = Inflector::underscore(preg_replace('/^findBy/i', '', $query));
			if ($field == 'id') {
				$field = $model->primaryKey;
			}
			return $model->find('first', array(
				'conditions' => array(
					$field => current($data),
				),
			));
		}
		if (strtolower($query) == 'freshbooks') {
			$this->__requestXml = current($data);
			$res = $this->_parseResponse(
				$this->http->get($this->url, null, array_merge(
					$this->__getAuthArray(),
					array('body' => $this->__requestXml)
				)
			));
			if ($res === false) {
				return false;
			}
			$this->_formatResponse($res);
			return $res;
		}
		if (strtolower($query) == 'requestxml') {
			return $this->__requestXml;
		}
		if (strtolower($query) == 'responsexml') {
			return $this->__responseXml;
		}
		throw new Exception(__d('freshbooks', 'Sorry, that find method is not supported.', true));
	}

/**
 * create
 * Handles create and update sub methods.
 *
 * @access public
 * @param object $model
 * @param array $fields
 * @param array $values
 * @return boolean
 */
	public function create(&$model, $fields=null, $values=null) {
		$method = (isset($model->method)) ? $model->method : Inflector::underscore($model->alias);
		$data = array_combine((array)$fields, (array)$values);
		if (isset($data[$model->primaryKey])) {
			$model->id = $data[$model->primaryKey];
			unset($data[$model->primaryKey]);
		}
		if ($model->id !== false) {
			$submethod = 'update';
			$data[$model->primaryKey] = $model->id;
		} else {
			$submethod = 'create';
		}
		$xml =& new Xml(array('Request' => array('method' => $method.'.'.$submethod)));
		$node =& new Xml(array($method => array()));
		foreach ($data as $key => $val) {
			if (is_array($val)) {
				$singular = Inflector::singularize($key);
				$val = array($key => array($singular => $val));
				@$node->first()->append($val, array('format' => 'tags'));
				unset($data[$key]);
			} elseif (substr($val, 0, 1) == '<') {
				$my_node =& new Xml($val);
				@$node->first()->append($my_node->children);
				unset($data[$key]);
			} else {
				$my = array($key => array(array($val)));
				@$node->first()->append($my);
			}
		}
		$xml->first()->append($node->children);
		$this->__requestXml = $xml->toString(array('header' => true));
		$res = $this->_parseResponse(
			$this->http->get($this->url, null, array_merge(
				$this->__getAuthArray(),
				array('body' => $this->__requestXml)
			)
		));
		if ($res === false) {
			return false;
		}
		if ($submethod == 'create') {
			$model->id = current(Set::extract('/Response/'.$model->primaryKey, $res));
		}
		return true;
	}

/**
 * update
 * Alias for create.
 *
 * @access public
 * @param object $model
 * @param array $fields
 * @param array $values
 * @return boolean
 */
	public function update(&$model, $fields=null, $values=null) {
		return $this->create($model, $fields, $values);
	}

/**
 * delete
 *
 * @access public
 * @param object $model
 * @param integer $id
 * @return boolean
 */
	public function delete(&$model, $id=null) {
		if ($id == null) {
			$id = $model->id;
			if ($id === false) {
				return false;
			}
		}
		$method = (isset($model->method)) ? $model->method : Inflector::underscore($model->alias);
		$xml =& new Xml(array('Request' => array('method' => $method.'.delete', $model->primaryKey => array($id))));
		$req = $xml->toString(array('header' => true));
		$res = $this->_parseResponse(
			$this->http->get($this->url, null, array_merge(
				$this->__getAuthArray(),
				array('body' => $req)
			)
		));
		if ($res === false) {
			return false;
		}
		return true;
	}

/**
 * _parseResponse
 * Either returns response as array or throws error.
 *
 * @param string $response
 * @return array
 */
	protected function _parseResponse($response=null) {
		if (empty($response)) {
			return false;
		}
		$this->__responseXml = $response;
		$xml =& new Xml($response);
		$arr = $xml->toArray();
		$status = trim(current(Set::extract('/Response/status', $arr)));
		if ($status != 'ok') {
			$err = current(Set::extract('/Response/error', $arr));
			if (empty($err)) {
				$err = 'An unknown error occurred.';
			}
			throw new Exception(__d('freshbooks', $err, true));
			return false;
		}
		return $arr;
	}

/**
 * _formatResponse
 * All keys in array lowercase and
 * blank arrays become ''
 *
 * @param array $data
 * @param integer $skip
 * @return array
 */
	protected function _formatResponse(&$data=null, $skip=2) {
		if ($skip == 0) {
			$data = array_change_key_case($data, CASE_LOWER);
		} else {
			$skip--;
		}
		foreach ($data as $key => $val) {
			if (is_array($val)) {
				if (sizeof($val) == 0) {
					$data[$key] = '';
				} else {
					$this->_formatResponse($data[$key], $skip);
				}
			}
		}
	}

/**
 * listSources
 * @return boolean
 */
	public function listSources() {
		return false;
	}

/**
 * describe
 *
 * @param object $model
 * @return array
 */
	public function describe(&$model) {
		if (isset($model->schema)) {
			return $model->schema;
		} else {
			return array('id' => array());
		}
	}

/**
* calculate
* Just return $func to give read() the field 'count'
*
* @param Model $model
* @param mixed $func
* @param array $params
* @return array
* @access public
*/
	public function calculate(&$model, $func, $params=array()) {
		return $func;
	}

/**
 * __getAuthArray
 * @return array
 */
	private function __getAuthArray() {
		return array(
			'auth' => array(
				'method' => 'Basic',
				'user' => $this->config['token'],
				'pass' => 'X',
			),
		);
	}
}