<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    var $uses = array('User','Company');
    public $components = array(
		'Session',
                /*'DebugKit.Toolbar',*/
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
    );
    
    function beforeFilter () {
        $current_user = $this->Auth->user();
        if (!empty($current_user)) {
            $this->set('current_user',$current_user);
        }
        
        if (!empty($current_user)&&$current_user['admin']=='0') {
            $this->loadModel('Company');
            $company = $this->Company->findById($current_user['company_id']);
            $connect = array('db_name'=>$company['Company']['db_name'],'db_password'=>$company['Company']['db_password']);
            die(print_r($current_user));
	    if (!empty($connect)&&$connect['db_name']!=''&&$connect['db_password']!='') {
		@App::import('ConnectionManager');
		$a = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => $connect['db_name'],
			'password' => $connect['db_password'],
			'database' => $connect['db_name'],
			'prefix' => '');
		try {
			ConnectionManager::create('new', $a);
		} catch (MissingDatabaseException $e) {
			$this->Session->setFlash('DB error: '.$e->getMessage());
		}
            }
        }
    }    
    
    /*function connect() {
        //$urlParts = explode('.', $_SERVER['HTTP_HOST']);
        
        $current_user = $this->Auth->user();
        if (!empty($current_user)) {
            $this->loadModel('Company');
            $company = $this->Company->findById($current_user['company_id']);
            return array('db_name'=>$company['Company']['db_name'],'db_password'=>$company['Company']['db_password']);
        } else {
            return array();
        }
    }*/
    
}
