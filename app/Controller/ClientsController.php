<?php
class ClientsController extends AppController {
 
	var $name = 'Clients';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Client','Category','Range','Vendor','Setting','Record','Field','Bill');
	var $components = array('Auth','Session','Email');
        
        function beforeFilter() {
		$allow = array('add');
		if ($this->Auth->user('id')==null && !in_array($this->params['action'],$allow)) {
			$this->Session->setFlash('You are not authorized to view that page.');
			$this->redirect('/login');
		}
		
		parent::beforeFilter();
		$this->Auth->allow('add');
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	function index ($w=null) {
		$this->layout = 'admin';
		$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
		if (isset($w)) {
			if ($w=='approved') {
				$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved'=>'1'));
				$this->set('show','Approved');
			} else {
				$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved'=>'2'));
				$this->set('show','Rejected');
			}
		} else {
			$opts = array('order'=>'Client.created DESC','conditions'=>array('Client.approved !='=>'0'));
			$this->set('show','All');
		}
		//$opts = array_unique($opts);
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
								$this->_approve(substr($row,5),'0');
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
		$clients = $this->Client->find('all',array('conditions'=>array('Client.approved'=>'0')));
		//$clients = array_unique($clients);
		$this->set(compact('clients'));
	}
	
	function add() {
		$this->set('fields',$this->Field->find('all'));
		if (!empty($this->request->data)) {
			$this->Client->create();
			foreach ($this->request->data as $row=>$value) {
					$field = $this->Field->findByName($row);
					if ($field['Field']['type']=='date') {
						$this->request->data['Client'][$row] = date('Y-m-d',strtotime($value));
					} elseif ($field['Field']['type']=='datetime') {
						$this->request->data['Client'][$row] = date('Y-m-d H:i:s',strtotime($value));
					}
			}			   
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
	
	function vendor_view ($id) {
		$this->layout = 'vendor';
		
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']==null||$userInfo['vendor_id']<1) {
			$this->redirect('/dashboard');
		}
		
		$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
		$this->set('unpaid',$unpaid);
		$this->set('count',count($unpaid));
		
		$this->set('fields',$this->Field->find('all'));
		$c = $this->Client->findById($id);
		if (isset($c)) {
			$this->set('c',$c);
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
		$this->_approve($id,'1');
	}
	
	function _approve($id,$mult) {
		
		$this->Client->id = $id;
		if ($this->Client->saveField('approved','1')) {
			$records = $this->Client->Record->find('all',array('conditions'=>array('Record.client_id'=>$id)));
			//find vendors
			$chosen = array();
			//set up joins for each type of search
			$j = array(
									array( 
									  'table' => 'categories_vendors', 
									  'alias' => 'CategoriesVendor', 
									  'type' => 'inner',  
									  'conditions'=> array('CategoriesVendor.vendor_id = Vendor.id') 
									), 
									array( 
									  'table' => 'categories', 
									  'alias' => 'Category', 
									  'type' => 'inner',  
									  'conditions'=> array( 
									      'Category.id = CategoriesVendor.category_id'
									  )
									),
									array( 
									  'table' => 'ranges_vendors', 
									  'alias' => 'RangesVendor', 
									  'type' => 'inner',  
									  'conditions'=> array('RangesVendor.vendor_id = Vendor.id') 
									), 
									array( 
									  'table' => 'ranges', 
									  'alias' => 'Range', 
									  'type' => 'inner',  
									  'conditions'=> array( 
									      'Range.id = RangesVendor.range_id'
									) 
			));			
			$joins = array(
									array( 
									  'table' => 'categories_vendors', 
									  'alias' => 'CategoriesVendor', 
									  'type' => 'inner',  
									  'conditions'=> array('CategoriesVendor.vendor_id = Vendor.id') 
									), 
									array( 
									  'table' => 'categories', 
									  'alias' => 'Category', 
									  'type' => 'inner',  
									  'conditions'=> array( 
									      'Category.id = CategoriesVendor.category_id'
									  ) 
			));
			foreach ($records as $r) {
				if ($r['Record']['select']=='1') {
					//for categories with ranges
					if ($r['Record']['range_id']!=NULL) {
						//need to get latest vendor per category
						$i=1;
						while ($i<200) {
							$this->Vendor->unbindModel(array('hasAndBelongsToMany'=>array('Category')));
							$this->Vendor->unbindModel(array('hasAndBelongsToMany'=>array('Range')));
							$vendor = $this->Vendor->find('first',array('joins'=>$j,'order'=>'Vendor.last_sent ASC','fields'=>array('Vendor.*'),'conditions'=>array('Vendor.active'=>'1',"Not"=>array('Vendor.id'=>$chosen),'CategoriesVendor.category_id'=>$r['Record']['category_id'],'RangesVendor.range_id'=>$r['Record']['range_id'])));
							
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
							$this->Vendor->unbindModel(array('hasAndBelongsToMany'=>array('Category')));
							$vendor = $this->Vendor->find('first',array('joins'=>$joins,'order'=>'Vendor.last_sent ASC','conditions'=>array('Vendor.active'=>'1',"Not"=>array('Vendor.id'=>$chosen),'CategoriesVendor.category_id'=>$r['Record']['category_id'])));
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
						if ($mult=='1') {
							$this->_mail($vendor['Vendor']['email'],$id,$r['Record']['range_id']);
						}
						
						$this->Record->id = $r['Record']['id'];
						$data = array();
						$data['Record']['sent'] = $mult;
						$data['Record']['vendor_id'] = $vendor['Vendor']['id'];
						$this->Record->save($data);
						$this->Record->id = false;						
						
						$chosen[] = $vendor['Vendor']['id'];						
						
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
						$data['Record']['sent'] = '0';
						$data['Record']['vendor_id'] = null;
						$this->Record->save($data);
						$this->Record->id = false;
					}
					
					unset($vendor);
					unset($i);
				}
			}
			if ($mult=='1') {
				return true;
			} else {
				$this->redirect(array('action'=>'pending'));
			}
		} else {
			$this->Session->setFlash('Error: Failed to Save');
		}
	}
	
	function _mail($to,$id,$range=null){
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		$client = $this->Client->findById($id);
		$this->set('name',$s['Setting']['site_url']);
		$this->set('u',$client);
		if ($range!=null) {
			$r = $this->Range->findById($range);
			$this->set('rr','Price Range: '.$r['Range']['name']);
		} else {
			$this->set('rr','');
		}
		$this->set('fields',$this->Field->find('all'));
		
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
	
	function export_xls() {
		$this->layout = 'export_xls';
		$this->Client->recursive = 0;
		
		$fields = $this->Field->find('list');
		$fields[] = 'approved';
		array_unshift($fields,'id');
		
		$data = $this->Client->find('all',array('fields'=>$fields,'order' => 'Client.id ASC'));
		
		$this->set('rows',$data);
		$this->response->header(array('Content-Disposition: attachment; filename="leads'.date('m-d-Y').'.xls"'));
		$this->response->type(array('xls' => 'application/vnd.ms-excel'));
		$this->response->type('xls');
	}
}

?>