<?php
class ClientsController extends AppController {
 
	var $name = 'Clients';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Client','Category','Range','Vendor','Setting','Record','Field');
	var $components = array('Auth','Session','Email');
        
        function beforeFilter() {
		parent::beforeFilter();
            $this->Auth->allow('add');
	    
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
		$this->Client->setDataSource('new');
		$this->Category->setDataSource('new');
		$this->Range->setDataSource('new');
		$this->Vendor->setDataSource('new');
		$this->Setting->setDataSource('new');
		$this->Record->setDataSource('new');
	    }*/
	    $this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	function index ($w=null) {
		$this->layout = 'admin';
		$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
		if (isset($w)) {
			if ($w=='approved') {
				$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved'=>'1'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
				$this->set('show','Approved');
			} else {
				$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved'=>'2'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
				$this->set('show','Rejected');
			}
		} else {
			$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved !='=>'0'),'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.phone','Client.created'));
			$this->set('show','All');
		}
		$clients = $this->Client->find('all',$opts);
		$this->set(compact('clients'));
		//die(print_r($clients));
	}
	
	//handles submissions from manage page
	function submit() {
		if (!empty($this->request->data)) {
			$url = $this->request->data['Client']['url'];
			switch ($this->request->data['Client']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Client'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Client->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/'.$url);
					break;
				case 'view':
					//edit code
					foreach ($this->request->data['Client'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/clients/view/'.substr($row,5));
							}
						}
					}
					break;
				case 'approve':
					//toggle status code
					foreach ($this->request->data['Client'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->_approve(substr($row,5),'submit');
							}
						}
					}
					$this->redirect('/pending');
					break;
				case 'reject':
					//toggle status code
					foreach ($this->request->data['Client'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Client->id = substr($row,5);
								$this->Client->saveField('approved','2');
								$this->Client->id = false;
							}
						}
					}
					$this->redirect('/pending');
					break;
				default:
					$this->redirect('/'.$url);
					break;
			}
			$this->redirect('/vendors/manage');
		} else {
			$this->redirect('/'.$url);
		}
	}
	
	function pending () {
		$this->layout = 'admin';
		$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
		$this->paginate = array('limit' => 18,'fields'=>array('DISTINCT Client.id','Client.first_name','Client.last_name','Client.wedding_date','Client.email','Client.approved','Client.zip','Client.created','Client.phone'),'conditions'=>array('Client.approved'=>'0'));
		$clients = $this->paginate('Client');
		$this->set(compact('clients'));
	}
	
	function add() {
		if (!empty($this->request->data)) {
			$w = $this->request->data['Client']['wedding_date'];
			$this->request->data['Client']['wedding_date'] = date('Y-m-d',strtotime($w));			   
			if ($this->Client->save($this->request->data)) {
				//$this->Session->setFlash('Thank you!  You will receive quotes shortly.');
				$i = $this->Client->find('first',array('order'=>'Client.created DESC','conditions'=>array('Client.last_name'=>$this->request->data['Client']['last_name'],'Client.zip'=>$this->request->data['Client']['zip'])));
				$id = $i['Client']['id'];
				$this->redirect(array('controller'=>'categories','action' => 'select/'.$id));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}
    
	function edit($id) {
		$this->set('id',$id);

		if (empty($this->request->data)) {
			$this->request->data = $this->Client->read();
		} else {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash('Client Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}
	
	function view ($id) {
		$this->layout = 'admin';
		$this->set('fields',$this->Field->find('all'));
		$c = $this->Client->findById($id);
		if (isset($c)) {
			$this->set('c',$c);
			$this->set('cats',$this->Category->find('list',array('fields'=>array('Category.name'))));
			$this->set('v',$this->Vendor->find('list',array('fields'=>array('Vendor.name'))));
		} else {
			$this->Session->setFlash('ID not found.');
			$this->redirect(array('action'=>'index'));
		}
	}
    
	function delete($id) {
		$this->Client->delete($id,true);
		$this->Session->setFlash('Client Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
	function reject($id) {
		$this->Client->id = $id;
		if ($this->Client->saveField('approved','2')) {
			//$this->Session->setFlash('');
		} else {
			$this->Session->setFlash('Error');
		}
		$this->redirect(array('action'=>'pending'));
	}
	
	function approve($id) {
		$this->_approve($id);
	}
	
	function _approve($id,$src=null) {
		$this->Client->id = $id;
		if ($this->Client->saveField('approved','1')) {
			$records = $this->Client->Record->find('all',array('conditions'=>array('Record.client_id'=>$id)));
			//find vendors
			foreach ($records as $r) {
				if ($r['Record']['select']=='1') {
					//for categories with ranges
					if ($r['Record']['range_id']!=null) {
						//need to get latest vendor per category
						$i=1;
						while ($i<200) {
							$this->Vendor->bindModel(array(
								'hasOne' => array(
									'RangesVendor',
									'FilterTag' => array(
										'className' => 'Range',
										'foreignKey' => false,
										'conditions' => array('FilterTag.id = RangesVendor.vendor_id')
							))));
							$vendor = $this->Vendor->find('first',array('order'=>'Vendor.last_sent ASC','fields'=>array('Vendor.*'),'conditions'=>array('Vendor.category_id'=>$r['Record']['category_id'],'RangesVendor.range_id'=>$r['Record']['range_id'])));
							
							if (!empty($vendor)) {
								if ($vendor['Vendor']['total_bill']==null) {
									$amt = 0;
								} else {
									$amt = $vendor['Vendor']['total_bill'];
								}
								if ($amt>=$vendor['Vendor']['leads_per_week']) {
									$i++;
								} else {
									$i=201;
								}
							} else {
								$i=201;
							}
						}
						
					//for categories without ranges	
					} else {
						$i=1;
						while ($i<200) {
							$vendor = $this->Vendor->find('first',array('order'=>'Vendor.last_sent ASC','conditions'=>array('Vendor.category_id'=>$r['Record']['category_id'])));
							if (!empty($vendor)) {
								if ($vendor['Vendor']['total_bill']==null) {
									$amt = 0;
								} else {
									$amt = $vendor['Vendor']['total_bill'];
								}
								if ($amt>=$vendor['Vendor']['leads_per_week']) {
									$i++;
								} else {
									$i=201;
								}
							} else {
								$i = 201;
							}
						} 
					}
					
					//make sure a vendor was found
					if (!empty($vendor)) {
						//common to each type
						$this->_mail($vendor['Vendor']['email'],$id,$r['Record']['range_id']);
						
						$this->Record->id = $r['Record']['id'];
						$data = array();
						$data['Record']['sent'] = '1';
						$data['Record']['vendor_id'] = $vendor['Vendor']['id'];
						$this->Record->save($data);
						$this->Record->id = false;
						
						$this->Vendor->id = $vendor['Vendor']['id'];
						$d = array();
						$d['Vendor']['total_all'] = $vendor['Vendor']['total_all']+1;
						$d['Vendor']['total_bill'] = $vendor['Vendor']['total_bill']+1;
						$d['Vendor']['last_sent'] = date('Y-m-d H:i:s');
						$this->Vendor->save($d);
						$this->Vendor->id = false;
					} else {
						$this->Record->id = $r['Record']['id'];
						$data = array();
						$data['Record']['sent'] = '1';
						$data['Record']['vendor_id'] = null;
						$this->Record->save($data);
						$this->Record->id = false;
					}
					
					unset($vendor);
					unset($i);
				}
			}
			if ($src==''||$src==null) {
				$this->redirect(array('action'=>'pending'));
			} else {
				return true;
			}
			
		} else {
			$this->Session->setFlash('Error: Failed to Save');
		}
	}
	
	function _mail($to,$id,$range=null){
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		$client = $this->Client->findById($id);
		$this->set('name',$s['Setting']['site_url']);
		$this->set('c',$client);
		if ($range!=null) {
			$r = $this->Range->findById($range);
			$this->set('rr','Price Range: '.$r['Range']['name']);
		} else {
			$this->set('rr','');
		}
		
		// Let the vendor know
		$this->Email->to = $to;
		$this->Email->subject = 'Lead from '.$s['Setting']['site_url'];
		$this->Email->replyTo = $s['Setting']['replyto_email'];
		$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
		$this->Email->template = 'lead'; 
		$this->Email->sendAs = 'both';
		$this->Email->send();
		//sleep(1);
		return true;
	}
	
	function findfb(){
		$company = $this->Company->findById($this->Auth->user('company_id'));
		require('freshbooks_api/FreshBooksRequest.php');
					
		$domain = $company['Company']['freshbooks_url'];
		$token = $company['Company']['freshbooks_api_token'];
		
		FreshBooksRequest::init($domain, $token);
		$fb = new FreshBooksRequest('client.list');
		//$fb->post(array('invoice_id'=>$fid));
		$fb->request();
		if ($fb->success()) {
			$result = $fb->getResponse();
			die(print_r($result));
		} else {
			die(print($fb->getError()));
		}
	}
}

?>