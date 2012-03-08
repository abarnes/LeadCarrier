<?php
class SettingsController extends AppController {
 
	var $name = 'Settings';
        var $layout = 'admin';
	//var $helpers = array('Html', 'Form', 'Time', 'javascript');
	public $uses = array('Setting','Client','User','Field');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        function beforeFilter() {
		parent::beforeFilter();
            //$this->Auth->allow('setup');
	    
	    /*$connect = $this->connect();
	    if (!empty($connect)) {
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
		$this->Setting->setDataSource('new');
		$this->Client->setDataSource('new');
	    }*/
	    $this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
	

	public function index() {
		$this->set('users',$this->User->find('all',array('conditions'=>array('vendor_id'=>null,'company_id'=>$this->Auth->user('company_id')))));
		$this->set('fields',$this->Field->find('all'));
		
		//find settings
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		$this->Setting->id = $s['Setting']['id'];
		$this->data = $this->Setting->read();
	}
	
	public function setup($id) {
		$this->layout = 'setup';
		$this->set('id',$id);
		if (!empty($this->request->data)) {
			//convert lead price to decimal format
			$this->request->data['Setting']['lead_price'] = substr($this->request->data['Setting']['lead_price'],1);
			if (substr($this->request->data['Setting']['site_url'],0,7)) {
				$this->request->data['Setting']['site_url'] = "http://".$this->request->data['Setting']['site_url'];
			}
			$this->Setting->create();
			if ($this->Setting->save($this->request->data,array('validate'=>true))) {
				$this->redirect(array('controller'=>'records','action' => 'dashboard'));
			}
		}
	}
        
	
	function edit() {
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		$this->Setting->id = $s['Setting']['id'];
		
		if (empty($this->request->data)) {
			$this->request->data = $this->Setting->read();
		} else {
			//convert lead price to decimal format
			$this->request->data['Setting']['lead_price'] = substr($this->request->data['Setting']['lead_price'],1);
			//save new settings
			if ($this->Setting->save($this->request->data)) {
				$this->Session->setFlash('Settings Updated');
				$this->redirect(array('controller'=>'settings','action' => 'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Settings (settings,edit)');
				$this->redirect(array('controller'=>'settings','action' => 'index'));
			}
		}
	}
    
}

?>