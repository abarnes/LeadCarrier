<?php
class CompaniesController extends AppController {
 
	var $name = 'Companies';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('Company','Client','Setting');
	public $components = array(
		'Session',
		'Password',
		'Email',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
    public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('register');
	    /*$admin = array('admin_index','admin_delete','admin_view');
	    if (in_array(Router::url($this->request->here, true),$admin)) {
		$userInfo = $this->Auth->user();
		if (empty($userInfo)||$userInfo['User']['admin']!='1') {
			$this->Session->setFlash('Access to this page is restricted to system administrators.');
			$this->redirect('/');
		}
	    }*/
    }
	
	public function register() {
		$this->layout = 'main';
		if (!empty($this->request->data)) {
			$this->request->data['Company']['api_token'] = $this->Password->__randomPassword('18');
			if ($this->Company->save($this->request->data)) {
				$this->redirect(array('controller'=>'databases','action' => 'db_setup/'.$this->Company->getLastInsertId()));
			} else {
				$this->Session->setFlash('Error: Registration Failure.  Please try again later.');
			}
		}
	}
	
	public function admin_index ($selection=null) {
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']!='1') {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}			
		
		$this->layout = 'admin';
		if ($selection=='active') {
			$data = $this->Company->find('all',array('conditions'=>array('Company.active'=>'1')));
			$this->set('show','Active');
		} elseif ($selection=='inactive') {
			$data = $this->Company->find('all',array('conditions'=>array('Company.active'=>'0')));
			$this->set('show','Inactive');
		} else {
			$data = $this->Company->find('all');
			$this->set('show','All');
		}
		$this->set('companies',$data);
	}
	
	//handles submissions from manage page
	public function admin_submit() {
		$userInfo = $this->Auth->user();
		//die(print_r($userInfo));
		if ($userInfo['admin']!=1) {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}
		
		if (!empty($this->request->data)) {
			switch ($this->request->data['Company']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Company'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Company->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/admin/companies');
					break;
				case 'view':
					//edit code
					foreach ($this->request->data['Company'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/admin/companies/view/'.substr($row,5));
							}
						}
					}
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Company'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/companies/edit/'.substr($row,5));
							}
						}
					}
					break;
				case 'active':
					//toggle status code
					foreach ($this->request->data['Company'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->_active(substr($row,5));
							}
						}
					}
					$this->redirect('/admin/companies');
					break;
				case 'inactive':
					//toggle status code
					foreach ($this->request->data['Company'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->_active(substr($row,5));
							}
						}
					}
					$this->redirect('/admin/companies');
					break;
				default:
					$this->redirect('/admin/companies');
					break;
			}
			$this->redirect('/admin/companies');
		} else {
			$this->redirect('/admin/companies');
		}
	}
	
	public function edit($id) {
		$this->layout = 'admin';		
		$userInfo = $this->Auth->user();
		if ($userInfo['company_id']!=$id&&$userInfo['admin']!=1) {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}
		
		$this->Company->id = $id;
		if (empty($this->request->data)) {
			$this->set('id',$id);
			$this->request->data = $this->Company->read();
			$this->set('c',$this->Company->findById($id));
			if ($userInfo['admin']==1) {
				$this->set('admin','1');
			} else {
				$this->set('admin','0');
				$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
			}
		} else {
			//die(print_r($this->request->data));
			if ($this->Company->save($this->request->data)) {
				$this->Session->setFlash('Company has been updated.');
				$this->redirect('/dashboard');
			} else {
				$this->Session->setFlash('Error: Failed to Save Information');
				$this->redirect('/companies/edit/'.$id);
			}
		}
	}
	
	public function admin_view($id) {
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']!='1') {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}		
		
		$this->layout = 'admin';
		$this->set('c',$this->Company->findById($id));		
	}
	
	public function admin_delete($id) {
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']!='1') {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}
		
		if ($this->Company->delete($id)) {
			$users = $this->User->find('all',array('conditions'=>array('User.company_id'=>$id)));
			foreach ($users as $u) {
				$this->User->delete($u['User']['id']);
			}
			$this->Session->setFlash('Company Successfully Deleted.');
			$this->redirect(array('action'=>'index'));
		} else {
			$this->Session->setFlash('Failed to Delete Company.');
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function admin_sendmail($id=null) {
		$userInfo = $this->Auth->user();
		if ($userInfo['admin']!='1') {
			$this->Session->setFlash('You do not have permission to view this page.');
			$this->redirect('/dashboard');
		}			
	
		if ($id==null) {
			$id = $this->request->data['Company']['i'];
		}
		$vendor = $this->Company->findById($id);		
		if (empty($vendor)) {
			$this->Session->setFlash('Error: failed to retrieve company information for email.');
			$this->redirect(array('controller'=>'companies','action'=>'index','admin'=>true));	
		}
		
		$this->set('d',$this->request->data['Company']);
		$s = $this->request->data['Company']['subject'];
		$this->Email->to = $vendor['Company']['email'];
		$this->Email->subject = $s;
		$this->Email->replyTo = 'info@leadcarrier.com';//$s['Setting']['replyto_email'];
		$this->Email->from =  'Lead Carrier <info@leadcarrier.com>';
		$this->Email->template = 'message'; 
		$this->Email->sendAs = 'both';
		$this->Email->send();		
		
		$this->Session->setFlash('Email sent to '.$vendor['Company']['name']);
		$this->redirect(array('controller'=>'companies','action'=>'index','admin'=>true));
		//die(print_r($this->request->data));
	}
	
	function admin_active($id) {
		$b = $this->Company->findById($id);
		$this->Company->id = $id;
			if ($b['Company']['active']=='1') {
				$this->Company->saveField('active','0');
				$this->Session->setFlash('Company set as inactive.');
			} else {
				$this->Company->saveField('active','1');
				$this->Session->setFlash('Company set as active.');
			}
		$this->redirect('/admin/companies');
	}
	
}

?>