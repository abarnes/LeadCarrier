<?php
class UsersController extends AppController {
 
	var $name = 'Users';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('User','Setting','Client','Bill');
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
		parent::beforeFilter();
		$this->Auth->allow('add','login','demo_login');
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
			$user = $this->User->findByUsername($this->request->data['User']['username']);
			if (!empty($user)) {
				$c = $this->Company->findById($user['User']['company_id']);
				if ($c['Company']['active']!='1') {
					$this->redirect('/companies/inactive');					
				}
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
	
	function demo_login(){
		$this->request->data = array();
		$this->request->data['User']['username'] = 'demo';
		$this->request->data['User']['password'] = 'demopassword';
		if ($this->Auth->login()) {
			//$this->redirect($this->Auth->redirect());
			$this->redirect('/dashboard');
		}
	}

	public function logout() {
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']!='') {
			$vendor = $this->Vendor->findById($userInfo['vendor_id']);
			//die(print('test'));
			$this->Auth->logout();
			$this->redirect('/v/'.$user['Vendor']['token']);
		} else {
			//die(print('test2'));
			$this->redirect($this->Auth->logout());
		}
	}
	
	//admins can add a user, either to a company or as another admin
	public function admin_add(){
		
	}
	
	//add a regular user, incl. after register public function
	public function add($id,$r=null) {
		$this->User->setDataSource('default');
		$this->Company->setDataSource('default');
		
		$userInfo = $this->Auth->user();
		if (!empty($userInfo)) {
			$this->layout = 'admin';
			$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
			$this->set('setup','0');
		} else {
			$this->layout = 'setup';
			$this->set('setup','1');
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
				$this->request->data['User']['company_id'] = $id;
				if (!empty($userInfo)&&$userInfo['admin']==1) {
					$this->request->data['User']['admin']='1';
				}
				    if ($this->User->save($this->request->data)) {
					    $this->Session->setFlash('"'.$this->request->data['User']['username'] . '" Successfully Added.');
					    if ($this->Auth->user('id')==null) {
						$user = $this->User->findById($this->User->getLastInsertId());
						$this->Auth->login($user['User']);
					    }
					    if ($r!=null) {
						if ($userInfo['admin']==0) {
							$this->redirect(array('controller'=>'settings','action' => 'index'));
						} else {
							$this->redirect(array('controller'=>'users','action' => 'index','admin'=>true));
						}
					    } else {
						$this->redirect(array('controller'=>'settings','action' => 'setup/'.$id));
					    }
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
				if ($this->Auth->user('admin')==1) {
					$this->redirect('/admin/users');
				} else {
					$this->redirect('/settings');	
				}
			}
		    }
		} else {
			$this->Session->setFlash('Authentication Error');
			if ($this->Auth->user('admin')==1) {
				$this->redirect('/admin/users');
			} else {
				$this->redirect('/settings');	
			}
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
	
	public function vendor_passwordchange($id = null) {
		$this->layout = 'vendor';
		$this->User->id = $id;
		$userInfo = $this->Auth->User();
		if ($userInfo['vendor_id']==null||$userInfo['vendor_id']<1) {
			$this->redirect('/dashboard');
		}
		
		$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
		$this->set('unpaid',$unpaid);
		$this->set('count',count($unpaid));
		
		$u = $this->User->findById($id);
		if ($u['User']['company_id']==$userInfo['company_id']||$userInfo['admin']=='1') {
			if (empty($this->request->data)) {
				//$this->request->data = $this->User->read();
				$this->set('name',$u['User']['username']);
				$this->set('id',$id);
			} else {
				$p2 = $this->request->data['User']['password2'];
				if ($this->request->data['User']['password'] == $p2  && strlen($p2)>='6') {
					if ($this->User->saveField('password',$this->request->data['User']['password']/*$this->Auth->password($this->request->data['User']['password'])*/)) {
						$this->Session->setFlash('Password Changed.');
						$this->redirect(array('controller'=>'records','action' => 'vendor_view'));
					}
				} else {
					$this->Session->setFlash('Passwords Did Not Match, Or Your New Password Is Less Than 6 Characters.');
				}
			}
		} else {
			$this->Session->setFlash('Authentication Error');
			$this->redirect('/records/vendor_view');
		}
	}
	
	public function delete($id) {
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']==1) {
			$redirect = '/admin/users';
		} else {
			$redirect = '/settings';
		}
		$u = $this->User->findById($id);
		if ($u['User']['company_id']==$this->Auth->user('company_id')||$this->Auth->user('admin')=='1') {
			$this->User->delete($id);
			$this->Session->setFlash('User Successfully Deleted.');
			$this->redirect($redirect);
		} else {
			$this->Session->setFlash('Authentication Error');
			$this->redirect($redirect);
		}
	}
	
	public function admin_index () {
		$this->layout = 'admin';
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']!='1') {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}
		
		$this->set('users',$this->User->find('all',array('conditions'=>array('company_id'=>$userInfo['company_id']))));
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