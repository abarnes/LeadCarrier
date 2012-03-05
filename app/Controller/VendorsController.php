<?php
class VendorsController extends AppController {
 
	var $name = 'Vendors';
        var $layout = 'admin';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Vendor','Bill','Category','Record','Setting','Client','Range','Field');
	public $components = array(
		'Session',
		'Email',
		'Password',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        function beforeFilter() {
		parent::beforeFilter();
            $this->Auth->allow('vadd','party','index');
	    //establish DB connection based on logged in user
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
		$this->Vendor->setDataSource('new');
		$this->Category->setDataSource('new');
		$this->Range->setDataSource('new');
		$this->Bill->setDataSource('new');
		$this->Record->setDataSource('new');
		$this->Setting->setDataSource('new');
		$this->Client->setDataSource('new');
	    }*/
	    $this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	
	function index() {
		$this->layout = 'default';
	}
	
	function manage () {
		$this->set('categories', $this->Category->find('list',array('order'=>'Category.name ASC')));
		$this->Vendor->recursive = 2;
		$vendors = $this->Vendor->find('all');	
		$this->set(compact('vendors'));
	}
	
	//handles submissions from manage page
	function submit() {
		if (!empty($this->request->data)) {
			switch ($this->request->data['Vendor']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Vendor'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Vendor->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/vendors/manage');
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Vendor'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/vendors/edit/'.substr($row,5));
							}
						}
					}
					break;
				case 'view':
					//edit code
					foreach ($this->request->data['Vendor'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/vendors/view/'.substr($row,5));
							}
						}
					}
					break;
				case 'active':
					//toggle status code
					foreach ($this->request->data['Vendor'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Vendor->id = substr($row,5);
								$this->Vendor->saveField('active','1');
								$this->Vendor->id = false;
							}
						}
					}
					$this->redirect('/vendors/manage');
					break;
				case 'inactive':
					//toggle status code
					foreach ($this->request->data['Vendor'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Vendor->id = substr($row,5);
								$this->Vendor->saveField('active','0');
								$this->Vendor->id = false;
							}
						}
					}
					$this->redirect('/vendors/manage');
					break;
				default:
					$this->redirect('/vendors/manage');
					break;
			}
			$this->redirect('/vendors/manage');
		} else {
			$this->redirect('/vendors/manage');
		}
	}
	
	function sel() {
		$this->set('categories', $this->Category->find('list',array('order'=>'Category.name ASC')));
		if (!empty($this->request->data)) {
			$this->redirect(array('action'=>'add/'.$this->request->data['Vendor']['category_id']));
		}
	}
	
	function add($cat) {
		$this->set('cat',$cat);
		$this->set('ranges', $this->Vendor->Range->find('list',array('conditions'=>array('Range.category_id'=>$cat),'fields'=>array('Range.id','Range.name'))));
		if (!empty($this->request->data)) {
			$this->request->data['Vendor']['category_id'] = $cat;
			if ($this->request->data['Vendor']['leads_per_week']==null || $this->request->data['Vendor']['leads_per_week']=='0' || $this->request->data['Vendor']['leads_per_week']=='') {
				$this->request->data['Vendor']['leads_per_week']='99999';
			}
			$username = $this->Password->__randomPassword('8');
			$this->request->data['Vendor']['token'] = $username;
			if ($this->Vendor->save($this->request->data)) {
				//freshbooks create
				$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				if ($setting['Setting']['use_freshbooks']=='1') {
					$id = $this->Vendor->getLastInsertId();
					require('freshbooks_api/FreshBooksRequest.php');
					
					$domain = $setting['Setting']['freshbooks_url'];
					$token = $setting['Setting']['freshbooks_api_token'];

					FreshBooksRequest::init($domain, $token);
					
					$fb = new FreshBooksRequest('client.create');
					// Any arguments you want to pass it
					$fb->post(array('client'=>array(
						'first_name' => '',		
						'last_name' => $this->request->data['Vendor']['contact_name'],
						'organization' => $this->request->data['Vendor']['name'],
						'email' => $this->request->data['Vendor']['email'],
						'work_phone'=>$this->request->data['Vendor']['phone'],
						'p_street1'=>$this->request->data['Vendor']['address1'],
						'p_street2'=>$this->request->data['Vendor']['address2'],
						'p_city'=>$this->request->data['Vendor']['city'],
						'p_state'=>$this->request->data['Vendor']['state'],
						'p_code'=>$this->request->data['Vendor']['zip'],
						'p_country'=>'United States',
						'notes'=>$this->request->data['Vendor']['notes']
						)
					));
					// Make the request
					$fb->request();
					if($fb->success())
					{
						$result = $fb->getResponse();
						$this->Vendor->id = $id;
						$this->Vendor->saveField('freshbooks_id',$result['client_id']);
						
						$d = array();
						$d['User']['username'] = $username;
						$d['user']['password'] = $this->Password->__randomPassword('8');
						$d['User']['vendor_id']=$this->Vendor->getLastInsertId();
						$d['User']['company_id'] = $this->Auth->user('company_id');
						$this->User->create();
						$this->User->save($d);
						
						$this->Session->setFlash('"'.$this->request->data['Vendor']['name'] . '" Successfully Added.');
						$this->redirect(array('controller'=>'vendors','action' => 'manage'));
					}
					else
					{
					    $this->Session->setFlash('Freshbooks Error: '.$fb->getError());
					    $this->redirect(array('controller'=>'vendors','action' => 'manage'));
					    //print_r($fb->getResponse());
					}
				} else {
					$this->Session->setFlash('"'.$this->request->data['Vendor']['name'] . '" Successfully Added.');
					$this->redirect(array('controller'=>'vendors','action' => 'manage'));
				}
			} else {
				$this->Session->setFlash('Error: Failed to Save Vendor');
			}
		}
	}
    
	function edit($id) {
		$this->set('id',$id);
		$this->Vendor->id = $id;
		$c = $this->Vendor->findById($id);
		if (empty($this->request->data)) {
			$this->request->data = $this->Vendor->read();
			$this->set('categories', $this->Category->find('list',array('order'=>'Category.name ASC')));
			$this->set('ranges', $this->Range->find('list',array('conditions'=>array('Range.category_id'=>$c['Vendor']['category_id']),'fields'=>array('Range.id','Range.name'))));
			$this->set('name',$this->request->data['Vendor']['name']);
		} else {
			if ($this->request->data['Vendor']['leads_per_week']==null || $this->request->data['Vendor']['leads_per_week']=='0' || $this->request->data['Vendor']['leads_per_week']=='') {
				$this->request->data['Vendor']['leads_per_week']='99999';
			}
			if ($this->Vendor->save($this->request->data)) {
								//freshbooks create
				$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				if ($setting['Setting']['use_freshbooks']=='1'&&$c['Vendor']['freshbooks_id']!='') {
					require('freshbooks_api/FreshBooksRequest.php');
					
					$domain = $setting['Setting']['freshbooks_url'];
					$token = $setting['Setting']['freshbooks_api_token'];

					FreshBooksRequest::init($domain, $token);
					
					$fb = new FreshBooksRequest('client.update');
					// Any arguments you want to pass it
					$fb->post(array('client'=>array(
						'client_id'=>$c['Vendor']['freshbooks_id'],
						'first_name' => '',		
						'last_name' => $this->request->data['Vendor']['contact_name'],
						'organization' => $this->request->data['Vendor']['name'],
						'email' => $this->request->data['Vendor']['email'],
						'work_phone'=>$this->request->data['Vendor']['phone'],
						'p_street1'=>$this->request->data['Vendor']['address1'],
						'p_street2'=>$this->request->data['Vendor']['address2'],
						'p_city'=>$this->request->data['Vendor']['city'],
						'p_state'=>$this->request->data['Vendor']['state'],
						'p_code'=>$this->request->data['Vendor']['zip'],
						'p_country'=>'United States',
						'notes'=>$this->request->data['Vendor']['notes']
						)
					));
					// Make the request
					$fb->request();
					if($fb->success())
					{
						$this->Session->setFlash('Vendor Has Been Updated.');
						$this->redirect(array('action'=>'view/'.$id));
					}
					else
					{
					    $this->Session->setFlash('Freshbooks Error: '.$fb->getError());
					    $this->redirect(array('controller'=>'vendors','action' => 'view/'.$id));
					    //print_r($fb->getResponse());
					}
				} else {
					$this->Session->setFlash('Vendor Has Been Updated.');
					$this->redirect(array('action'=>'view/'.$id));
				}
			} else {
				$this->Session->setFlash('Error: Failed to Save Vendor');
			}
		}
	}
	
	function vendor_edit() {
		$this->layout = 'vendor';
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']==null||$userInfo['vendor_id']<1) {
			$this->redirect('/dashboard');
		}
		$id = $userInfo['vendor_id'];
		$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
		$this->set('unpaid',$unpaid);
		$this->set('count',count($unpaid));
		
		$this->set('id',$id);
		$this->Vendor->id = $id;
		$c = $this->Vendor->findById($id);
		if (empty($this->request->data)) {
			$this->request->data = $this->Vendor->read();
			$this->set('categories', $this->Category->find('list',array('order'=>'Category.name ASC')));
			$this->set('ranges', $this->Range->find('list',array('conditions'=>array('Range.category_id'=>$c['Vendor']['category_id']),'fields'=>array('Range.id','Range.name'))));
			$this->set('name',$this->request->data['Vendor']['name']);
		} else {
			if ($this->request->data['Vendor']['leads_per_week']==null || $this->request->data['Vendor']['leads_per_week']=='0' || $this->request->data['Vendor']['leads_per_week']=='') {
				$this->request->data['Vendor']['leads_per_week']='99999';
			}
			if ($this->Vendor->save($this->request->data)) {
								//freshbooks create
				$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				if ($setting['Setting']['use_freshbooks']=='1'&&$c['Vendor']['freshbooks_id']!='') {
					require('freshbooks_api/FreshBooksRequest.php');
					
					$domain = $setting['Setting']['freshbooks_url'];
					$token = $setting['Setting']['freshbooks_api_token'];

					FreshBooksRequest::init($domain, $token);
					
					$fb = new FreshBooksRequest('client.update');
					// Any arguments you want to pass it
					$fb->post(array('client'=>array(
						'client_id'=>$c['Vendor']['freshbooks_id'],
						'first_name' => '',		
						'last_name' => $this->request->data['Vendor']['contact_name'],
						'organization' => $this->request->data['Vendor']['name'],
						'email' => $this->request->data['Vendor']['email'],
						'work_phone'=>$this->request->data['Vendor']['phone'],
						'p_street1'=>$this->request->data['Vendor']['address1'],
						'p_street2'=>$this->request->data['Vendor']['address2'],
						'p_city'=>$this->request->data['Vendor']['city'],
						'p_state'=>$this->request->data['Vendor']['state'],
						'p_code'=>$this->request->data['Vendor']['zip'],
						'p_country'=>'United States',
						'notes'=>$this->request->data['Vendor']['notes']
						)
					));
					// Make the request
					$fb->request();
					if($fb->success())
					{
						$this->Session->setFlash('Vendor Has Been Updated.');
						$this->redirect(array('action'=>'view/'.$id));
					}
					else
					{
					    $this->Session->setFlash('Freshbooks Error: '.$fb->getError());
					    $this->redirect(array('controller'=>'vendors','action' => 'view/'.$id));
					    //print_r($fb->getResponse());
					}
				} else {
					$this->Session->setFlash('Vendor Has Been Updated.');
					$this->redirect(array('action'=>'view/'.$id));
				}
			} else {
				$this->Session->setFlash('Error: Failed to Save Vendor');
			}
		}
	}
	
	function view ($id,$w=null) {
		$this->layout = 'admin';
		$c = $this->Vendor->findById($id);
		if (isset($c)) {
			$this->Vendor->id = $id;
			$this->request->data = $this->Vendor->read();
			$this->set('categories', $this->Category->find('list',array('order'=>'Category.name ASC')));
			$this->set('ranges', $this->Range->find('list',array('conditions'=>array('Range.category_id'=>$c['Vendor']['category_id']),'fields'=>array('Range.id','Range.name'))));
			$this->set('c',$c);
			if ($w==null) {
				$h = $this->Record->find('all',array('limit' => 20,'order'=>'Record.created DESC','conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1')));
				$this->set('clients',$h);
				//$this->set('b',$this->Vendor->Record->find('all',array('conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'))));
				$this->set('w','leads');
				$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				$this->set('price',$s['Setting']['lead_price']);
				$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
				//die(print_r($h));
			} else {
				if ($w=='billing') {
					$this->paginate = array('limit' => 20,'order'=>'Bill.end_timestamp DESC','conditions'=>array('Bill.vendor_id'=>$id));
					$h = $this->paginate('Bill');
					$this->set('h',$h);
					//$this->set('h',$this->Vendor->Bill->find('all',array('conditions'=>array('Bill.vendor_id'=>$id))));
					$this->set('w','billing');
				} else {
					$h = $this->Record->find('all',array('limit' => 20,'order'=>'Record.created DESC','conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1')));
					$this->set('clients',$h);
					//$this->set('b',$this->Vendor->Record->find('all',array('conditions'=>array('Record.vendor_id'=>$id,'Record.sent'=>'1'))));
					$this->set('w','leads');
					$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
					$this->set('price',$s['Setting']['lead_price']);
					$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
				}
			}
		} else {
			$this->Session->setFlash('ID not found.');
			$this->redirect(array('action'=>'manage'));
		}
	}
	
	function paid($id) {
		$b = $this->Vendor->Bill->findById($id);
		$this->Vendor->Bill->id = $id;
			if ($b['Bill']['paid']=='1') {
				$this->Bill->saveField('paid','0');
				$this->Session->setFlash('Bill marked as unpaid.');
			} else {
				$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
				if ($setting['Setting']['use_freshbooks']=='1') {
					require('freshbooks_api/FreshBooksRequest.php');
								
					$domain = $setting['Setting']['freshbooks_url'];
					$token = $setting['Setting']['freshbooks_api_token'];
					FreshBooksRequest::init($domain, $token);
					$fb = new FreshBooksRequest('payment.create');
					$fb->post(array('payment'=>array('invoice_id'=>$b['Bill']['freshbooks_invoice_id'],'amount'=>$b['Bill']['total'])));
					$fb->request();
					if ($fb->success()) {
						$this->Bill->saveField('paid','1');
						$this->Session->setFlash('Bill marked as paid.');
					} else {
						$this->Session->setFlash('Error opening page: '.$fb->getError());
					}
				} else {
					$this->Bill->saveField('paid','1');
					$this->Session->setFlash('Bill marked as paid.');
				}
			}
		$this->redirect(array('action'=>'view/'.$b['Bill']['vendor_id'].'/billing'));
	}
    
	function delete($id) {
		$this->Vendor->delete($id);
		$this->Session->setFlash('Vendor Successfully Deleted.');
		$this->redirect(array('action'=>'manage'));
	}
	
	function vadd() {
		if (!empty($this->request->data)) {
			if ($this->request->data['Vendor']['agree']!='1') {
				$this->Session->setFlash('Please read the Terms of Use.');
				$this->redirect(array('controller'=>'vendors','action'=>'index'));
			}
			$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
			$this->set('d',$this->request->data);
			
			$this->Email->to = 'info@myweddingconnector.com';
			$this->Email->subject = 'New Vendor';
			$this->Email->replyTo = $s['Setting']['replyto_email'];
			$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
			$this->Email->template = 'vendor'; 
			$this->Email->sendAs = 'both';
			$this->Email->send();
			
			$this->Session->setFlash('Thank you!  We will contact you shortly.');
			$this->redirect(array('controller'=>'vendors','action'=>'index'));
		} else {
			$this->redirect(array('action'=>'index','controller'=>'vendors'));
		}
	}
	
	function sendmail($id=null) {
		if ($id==null) {
			$id = $this->request->data['Vendor']['i'];
		}
		$vendor = $this->Vendor->findById($id);		
		if (empty($vendor)) {
			$this->Session->setFlash('Error: failed to retrieve vendor information for email.');
			$this->redirect(array('controller'=>'vendors','action'=>'manage'));	
		}
		
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		$this->set('d',$this->request->data['Vendor']);
			
		$this->Email->to = $vendor['Vendor']['email'];
		$this->Email->subject = $this->request->data['Vendor']['subject'];
		$this->Email->replyTo = $s['Setting']['replyto_email'];
		$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
		$this->Email->template = 'message'; 
		$this->Email->sendAs = 'both';
		$this->Email->send();		
		
		$this->Session->setFlash('Email sent to '.$vendor['Vendor']['name']);
		$this->redirect(array('controller'=>'vendors','action'=>'manage'));
		//die(print_r($this->request->data));
	}
}

?>