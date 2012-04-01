<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class SettingsController extends AppController {
 
	var $name = 'Settings';
        var $layout = 'admin';
	//var $helpers = array('Html', 'Form', 'Time', 'javascript');
	public $uses = array('Setting','Client','User','Field','Vendor');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        function beforeFilter() {
		$allow = array();
		if ($this->Auth->user('id')==null && !in_array($this->params['action'],$allow)) {
			$this->Session->setFlash('You are not authorized to view that page.');
			$this->redirect('/login');
		}
		parent::beforeFilter();
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
	

	public function index() {
		$this->set('users',$this->User->find('all',array('conditions'=>array('vendor_id'=>null,'company_id'=>$this->Auth->user('company_id')))));
		$this->set('fields',$this->Field->find('all'));
		
		//find settings
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		$this->Setting->id = $s['Setting']['id'];
		
		//$this->data = $this->Setting->read();
		if (empty($this->request->data)) {
			$this->request->data = $this->Setting->read();
		} else {
			//convert lead price to decimal format
			if (isset($this->request->data['Setting']['lead_price'])) {
				$this->request->data['Setting']['lead_price'] = substr($this->request->data['Setting']['lead_price'],1);
			}
			
			//format URL
			if (substr($this->request->data['Setting']['site_url'],0,7)!='http://') {
				$this->request->data['Setting']['site_url'] = "http://".$this->request->data['Setting']['site_url'];
			}
			
			//save new settings
			$this->request->data['Setting']['use_freshbooks']=$s['Setting']['use_freshbooks'];
			$this->request->data['Setting']['freshbooks_url']=$s['Setting']['freshbooks_url'];
			$this->request->data['Setting']['freshbooks_api_token']=$s['Setting']['freshbooks_api_token'];
			$this->Setting->set($this->request->data);
			if ($this->Setting->validates()) {
				if ($this->Setting->save($this->request->data,false)) {
					$this->Session->setFlash('Settings Updated');
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				} else {
					$this->Session->setFlash('Error: Failed to Save Settings');
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				}
			} else {
				$this->set('errors',$this->Setting->validationErrors);				
			}
		}
	}
	
	public function setup($id) {
		$this->layout = 'setup';
		$this->set('id',$id);
		if (!empty($this->request->data)) {
			//convert lead price to decimal format
			$this->request->data['Setting']['lead_price'] = substr($this->request->data['Setting']['lead_price'],1);
			
			//format URL
			if (substr($this->request->data['Setting']['site_url'],0,7)!='http://') {
				$this->request->data['Setting']['site_url'] = "http://".$this->request->data['Setting']['site_url'];
			}
			
			//check freshbooks
			if ($this->request->data['Setting']['use_freshbooks']=='1') {
				$domain = $this->request->data['Setting']['freshbooks_url'];
				$token = $this->request->data['Setting']['freshbooks_api_token'];
				require('freshbooks_api/FreshBooksRequest.php');
				FreshBooksRequest::init($domain, $token);
				$fb = new FreshBooksRequest('system.current');
				$fb->request();
				if($fb->success()) {
					//request succeeded
					$go = '1';
				} else {
					$go = '0';
					$this->Session->setFlash('Freshbooks Authentication Failed.  Please Check Your Credentials.');
				}
				
			} else {
				$go = '1';
			}
			if ($go=='1') {
				$this->Setting->create();
				if ($this->Setting->save($this->request->data,array('validate'=>true))) {
					$this->redirect(array('controller'=>'records','action' => 'dashboard'));
				}
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
			if (isset($this->request->data['Setting']['lead_price'])) {
				$this->request->data['Setting']['lead_price'] = substr($this->request->data['Setting']['lead_price'],1);
			}
			
			//format URL
			if (substr($this->request->data['Setting']['site_url'],0,7)!='http://') {
				$this->request->data['Setting']['site_url'] = "http://".$this->request->data['Setting']['site_url'];
			}
			
			//save new settings
			$this->Setting->set($this->request->data);
			if ($this->Setting->validates()) {
				if ($this->Setting->save($this->request->data,false)) {
					$this->Session->setFlash('Settings Updated');
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				} else {
					$this->Session->setFlash('Error: Failed to Save Settings');
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				}
			} else {
				$this->set('errors',$this->Setting->validationErrors);				
			}
		}
	}
	
	function freshbooks_edit() {
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		$this->Setting->id = $s['Setting']['id'];
		
		if (!empty($this->request->data)) {
			//check freshbooks
			if ($this->request->data['Setting']['use_freshbooks']=='1') {
				$domain = $this->request->data['Setting']['freshbooks_url'];
				$token = $this->request->data['Setting']['freshbooks_api_token'];
				require('freshbooks_api/FreshBooksRequest.php');
				FreshBooksRequest::init($domain, $token);
				$fb = new FreshBooksRequest('system.current');
				$fb->request();
				if($fb->success()) {
					//request succeeded
					$go = '1';
				} else {
					$go = '0';
					$this->Session->setFlash('Freshbooks Authentication Failed.  Please Check Your Credentials.');
					$this->redirect('/settings');
				}
				
			} else {
				$go = '1';
			}
			
			if ($go=='1') {
				//save new settings
				if ($this->Setting->save($this->request->data,array('validate'=>false))) {
					if ($this->request->data['Setting']['use_freshbooks']=='1') {
						$resp = $this->_freshbooks_check();
						if ($resp=='success') {
							$this->Session->setFlash('Settings Updated and Synced with Freshbooks.');
						} else {
							$this->Session->setFlash('Settings Updated, but a Freshbooks error was encountered: '.$resp);
						}
					} else {
						$this->Session->setFlash('Settings Updated.');	
					}
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				} else {
					$this->Session->setFlash('Error: Failed to Save Settings');
					$this->redirect(array('controller'=>'settings','action' => 'index'));
				}
			}
		}
	}
	
	function _freshbooks_check() {
		$vendors = $this->Vendor->find('all');
		$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		require_once('freshbooks_api/FreshBooksRequest.php');			
		$domain = $setting['Setting']['freshbooks_url'];
		$token = $setting['Setting']['freshbooks_api_token'];
		FreshBooksRequest::init($domain, $token);
		
		foreach ($vendors as $v) {
			if ($v['Vendor']['freshbooks_id']!='') {
				//already has a freshbooks ID - verify it
				//FreshBooksRequest::init($domain, $token);
				$fb = new FreshBooksRequest('client.get');
				$fb->post(array('client_id'=>$v['Vendor']['freshbooks_id']));
				
				// Make the request
				$fb->request();
				if($fb->success())
				{
					$result = $fb->getResponse();
					//make sure it matches our database.  recreate if not
					if ($result['client']['organization']!=$v['Vendor']['name']) {
						//FreshBooksRequest::init($domain, $token);
						$fb2 = new FreshBooksRequest('client.create');
						
						$fb2->post(array('client'=>array(
							'first_name' => '',		
							'last_name' => $v['Vendor']['contact_name'],
							'organization' => $v['Vendor']['name'],
							'email' => $v['Vendor']['email'],
							'work_phone'=>$v['Vendor']['phone'],
							'p_street1'=>$v['Vendor']['address1'],
							'p_street2'=>$v['Vendor']['address2'],
							'p_city'=>$v['Vendor']['city'],
							'p_state'=>$v['Vendor']['state'],
							'p_code'=>$v['Vendor']['zip'],
							'p_country'=>'United States',
							'notes'=>$v['Vendor']['notes']
							)
						));
						// Make the request
						$fb2->request();
						if($fb2->success())
						{
							$result = $fb2->getResponse();
							$this->Vendor->id = $v['Vendor']['id'];
							$this->Vendor->saveField('freshbooks_id',$result['client_id']);
						} else {
							return $fb2->getError();
							exit();
						}
					}
				} else {
					/*return $fb->getError();
					exit();*/
				}
				unset($fb);
				unset($fb2);
			} else {
				//need to create a new client					
					//FreshBooksRequest::init($domain, $token);
					$fb = new FreshBooksRequest('client.create');
					
					$fb->post(array('client'=>array(
						'first_name' => '',		
						'last_name' => $v['Vendor']['contact_name'],
						'organization' => $v['Vendor']['name'],
						'email' => $v['Vendor']['email'],
						'work_phone'=>$v['Vendor']['phone'],
						'p_street1'=>$v['Vendor']['address1'],
						'p_street2'=>$v['Vendor']['address2'],
						'p_city'=>$v['Vendor']['city'],
						'p_state'=>$v['Vendor']['state'],
						'p_code'=>$v['Vendor']['zip'],
						'p_country'=>'United States',
						'notes'=>$v['Vendor']['notes']
						)
					));
					// Make the request
					$fb->request();
					if($fb->success())
					{
						$result = $fb->getResponse();
						$this->Vendor->id = $v['Vendor']['id'];
						$this->Vendor->saveField('freshbooks_id',$result['client_id']);
					} else {
						return $fb->getError();
						exit();
					}
			}
			unset($fb);
		}
		return 'success';
	}
    
}

?>