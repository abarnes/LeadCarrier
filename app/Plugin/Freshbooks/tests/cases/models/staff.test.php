<?php
/**
 * Staff Test
 * 
 * @package freshcake
 * @author Kyle Robinson Young <kyle at kyletyoung.com>
 */
App::import('Model', array('ConnectionManager', 'Freshbooks.Staff'));
App::import('Core', array('HttpSocket', 'Xml'));
App::import('Helper', 'Xml');
Mock::generate('HttpSocket');

class StaffTest extends CakeTestCase {

/**
 * name
 */
	public $name = 'Staff';

/**
 * Model
 * @var object
 */
	public $Model = null;

/**
 * Ds
 * @var object
 */
	public $Ds = null;

/**
 * ds_name
 * @var string
 */
	public $ds_name = 'freshbooks_temp';

/**
 * successXml
 * @var array
 */
	public $successXml = array(
		'response' => array(
			'status' => 'ok',
		),
	);

/**
 * start
 */
	public function start() {
		$this->Ds =& ConnectionManager::create($this->ds_name, array(
			'datasource' => 'freshbooks.freshbooks',
			'subdomain' => 'test',
			'token' => '1234',
		));
		if ($this->Ds == null) {
			$this->Ds =& ConnectionManager::getDataSource($this->ds_name);
		}
		$this->Model =& new $this->name(array(
			'alias' => $this->name,
			'ds' => $this->ds_name,
		));
	}

/**
 * testRead
 */
	public function testRead() {
		// TEST LIST
		$xml =& new Xml($this->successXml);
		$node =& new Xml(array(
			'staff_members' => array(
				'member' => array(
					array(
						'staff_id' => 13,
						'username' => 'test',
						'first_name' => 'Test',
						'last_name' => 'Person',
						'email' => 'test@example.com',
					),
					array(
						'staff_id' => 14,
						'username' => 'testy',
						'first_name' => 'Testy',
						'last_name' => 'Persony',
						'email' => 'test@example.com',
					),
				),
			),
		), array('format' => 'tags'));
		$xml->first()->append($node->children);
		
		$this->Ds->http =& new MockHttpSocket();
		$this->Ds->http->setReturnValue('get', $xml->toString());
		
		$res = $this->Model->find('all');
		$this->assertEqual($res, array(
			0 => array(
				'Staff' => array(
					'staff_id' => 13,
					'username' => 'test',
					'first_name' => 'Test',
					'last_name' => 'Person',
					'email' => 'test@example.com',
				),
			),
			1 => array(
				'Staff' => array(
					'staff_id' => 14,
					'username' => 'testy',
					'first_name' => 'Testy',
					'last_name' => 'Persony',
					'email' => 'test@example.com',
				),
			),
		));
		unset($xml, $node, $res);
		
		// TEST GET
		$xml =& new Xml($this->successXml);
		$node =& new Xml(array(
			'staff' => array(
				'staff_id' => 13,
				'username' => 'test',
				'first_name' => 'Test',
				'last_name' => 'Person',
				'email' => 'test@example.com',
			),
		), array('format' => 'tags'));
		$xml->first()->append($node->children);
		
		$this->Ds->http =& new MockHttpSocket();
		$this->Ds->http->setReturnValue('get', $xml->toString());
		
		$res = $this->Model->findById(13);
		$this->assertEqual($res, array(
			'Staff' => array(
				'staff_id' => 13,
				'username' => 'test',
				'first_name' => 'Test',
				'last_name' => 'Person',
				'email' => 'test@example.com',
			),
		));
		unset($xml, $node, $res);
		
	}


	public function testCurrent() {
		$xml =& new Xml($this->successXml);
		$node =& new Xml(array(
			'Staff' => array(
				'staff_id' => 13,
				'username' => 'test',
				'first_name' => 'Test',
				'last_name' => 'Person',
				'email' => 'test@example.com',
			),
		), array('format' => 'tags'));
		$xml->first()->append($node->children);
		
		$this->Ds->http =& new MockHttpSocket();
		$this->Ds->http->setReturnValue('get', $xml->toString());
		
		$res = $this->Model->current();
		$this->assertEqual($res, array(
			'Staff' => array(
				'staff_id' => 13,
				'username' => 'test',
				'first_name' => 'Test',
				'last_name' => 'Person',
				'email' => 'test@example.com',
			),
		));
		unset($xml);
	}

/**
 * end
 */
	public function end() {
		unset($this->Ds);
		unset($this->Model);
		Cache::clear(false, 'freshbooks');
	}

}