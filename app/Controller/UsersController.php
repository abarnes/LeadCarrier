<?php
class UsersController extends AppController {
 
	var $name = 'Users';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('User','Setting','Client');
	public $components = array(
		'Session',
		'Cookie',
		'Auth' => array(
		    'loginAction' => array(
			'controller' => 'users',
			'action' => 'lg'
			//'plugin' => 'users'
		    ),
		    'loginRedirect' => array('controller' => 'records', 'action' => 'dashboard'),
		    'logoutRedirect' => array('controller' => 'users', 'action' => 'login')
		)
	);
	
        public function beforeFilter() {
		//parent::beforeFilter();
		$this->Auth->allow('add','login');
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
		}	*/	
        }
	
        public function login() {
		$n = $this->Cookie->read('uname');
			if ($n!=null) {
				$this->set('name',$n);
			} else {
				$this->set('name','');	
			}
	}
	
	public function lg(){
		//only for login logic
		if (!empty($this->request->data)) {
			if ($this->request->data['User']['remember']=='1'||$this->request->data['User']['remember']==true) {
				$this->Cookie->write('uname',$this->data['User']['username'],false, '6 months');
			} else {
				$this->Cookie->delete('uname');
			}
			if ($this->Auth->login()) {
				//record last login
				//
			    $this->redirect($this->Auth->redirect());
			} else {
			    $this->Session->setFlash(__('Invalid username or password.'));
			    $this->redirect('/login');
			}
		}	
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	//admins can add a user, either to a company or as another admin
	public function admin_add(){
		
	}
	
	//add a regular user, incl. after register public function
	public function add($id) {
		$this->User->setDataSource('default');
		$this->Company->setDataSource('default');
		
		$userInfo = $this->Auth->user();
		if (!empty($userInfo)) {
			$this->layout = 'admin';
			$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
		} else {
			$this->layout = 'main';	
		}
		$this->set('id',$id);
		$company = $this->User->Company->findById($id);
		if(!empty($company)) {
			$compid = $company['Company']['id'];
		} else {
			$this->Session->setFlash('Could not find associate company.');
			$this->redirect('/settings');
		}
		    if (!empty($this->request->data)) {
			    $p2 = $this->request->data['User']['password2'];
			    if ($this->request->data['User']['password'] == $p2) {
				$this->request->data['User']['company_id'] = $id; 
				    if ($this->User->save($this->request->data)) {
					    $this->Session->setFlash('"'.$this->request->data['User']['username'] . '" Successfully Added.');
					    if ($this->Auth->user('id')==null) {
						$this->Auth->login($this->request->data['User']);
					    }
					    $this->redirect(array('controller'=>'settings','action' => 'setup/'.$id));
				    } else {
					    $this->Session->setFlash('Failed to Save User');
					    $this->redirect('/settings');
				    }
			    } else {
				    $this->Session->setFlash('Passwords Did Not Match.  Please Try Again.');
				    $this->redirect(array('action'=>'add/'.$id));
			    }
		    }
	}
    
	public function edit($id) {
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
		$this->layout = 'admin';
		$this->set('id',$id);
		$this->User->id = $id;
		$u = $this->User->findById($id);
		if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
		    if (empty($this->request->data)) {
			    $this->request->data = $this->User->read();
		    } else {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('User Information Has Been Updated.');
				$this->redirect('/settings');
			}
		    }
		} else {
			$this->Session->setFlash('Authentication Error');
			$this->redirect('/settings');
		}
	}
	
	public function view($id) {
		
	}
	
	public function passwordchange($id = null) {
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
		$this->layout = 'admin';
		$this->User->id = $id;
		$userinfo = $this->Auth->User();
		$u = $this->User->findById($id);
		if ($u['User']['company_id']==$userinfo['company_id']||$userinfo['admin']=='1') {
			if (empty($this->request->data)) {
				//$this->request->data = $this->User->read();
				$this->set('name',$u['User']['username']);
				$this->set('id',$id);
			} else {
				$p2 = $this->request->data['User']['password2'];
				if ($this->request->data['User']['password'] == $p2  && strlen($p2)>='6') {
					if ($this->User->saveField('password',$this->request->data['User']['password']/*$this->Auth->password($this->request->data['User']['password'])*/)) {
						$this->Session->setFlash('Password Changed.');
						$this->redirect(array('controller'=>'settings','action' => 'index'));
					}
				} else {
					$this->Session->setFlash('Passwords Did Not Match, Or Your New Password Is Less Than 6 Characters.');
				}
			}
		} else {
			$this->Session->setFlash('Authentication Error');
			$this->redirect('/settings');
		}
	}
    
	public function delete($id) {
		$u = $this->User->findById($id);
		if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
			$this->User->delete($id);
			$this->Session->setFlash('User Successfully Deleted.');
			$this->redirect('/settings');
		} else {
			$this->Session->setFlash('Authentication Error');
			$this->redirect('/settings');
		}
	}
	
	public function index () {
	
	}
	
	public function submit() {
			if (!empty($this->request->data)) {
			switch ($this->request->data['User']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['User'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$u = $this->User->findById(substr($row,5));
								if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
									$this->User->delete(substr($row,5));
								} else {
									$this->Session->setFlash('Authentication Error.');
									$this->redirect('/settings');
								}
							}
						}
					}
					$this->redirect('/settings');
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['User'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$u = $this->User->findById(substr($row,5));
								if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
									$this->redirect('/users/edit/'.substr($row,5));
								} else {
									$this->Session->setFlash('Authentication Error.');
									$this->redirect('/settings');
								}
							}
						}
					}
					break;
				case 'password':
					//edit code
					foreach ($this->request->data['User'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$u = $this->User->findById(substr($row,5));
								if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
									$this->redirect('/users/passwordchange/'.substr($row,5));
								} else {
									$this->Session->setFlash('Authentication Error.');
									$this->redirect('/settings');
								}
							}
						}
					}
					break;
				default:
					$this->redirect('/settings');
					break;
			}
			$this->redirect('/settings');
		} else {
			$this->redirect('/settings');
		}
	}

}

?>