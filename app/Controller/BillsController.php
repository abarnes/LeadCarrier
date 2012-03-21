<?php
class BillsController extends AppController {
 
	var $name = 'Bills';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('Company','Client','Setting','Bill','Field');
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
	}
	
	public function index() {
		$this->layout = 'vendor';
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']==null||$userInfo['vendor_id']<1) {
			$this->redirect('/dashboard');
		}
		
		$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
		$this->set('unpaid',$unpaid);
		$this->set('count',count($unpaid));
		
		$this->set('bills',$this->Bill->find('all',array('conditions'=>array('Bill.vendor_id'=>$userInfo['vendor_id']))));
	}
	
	public function view($id) {
		$this->layout = 'vendor';
		$bill = $this->Bill->findById($id);
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']!=''&&$userInfo['vendor_id']==$bill['Bill']['vendor_id']) {
			$this->set('bill',$bill);
			
			$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
			$this->set('unpaid',$unpaid);
			$this->set('count',count($unpaid));
			$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
		} else {
			$this->Session->setFlash('You do not have permission to view this.');
			$this->redirect('/clients/vendor_view');
		}
	}
	
	public function view_freshbooks_bill($fid) {
		$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		require('freshbooks_api/FreshBooksRequest.php');
					
		$domain = $setting['Setting']['freshbooks_url'];
		$token = $setting['Setting']['freshbooks_api_token'];
		
		FreshBooksRequest::init($domain, $token);
		$fb = new FreshBooksRequest('invoice.get');
		$fb->post(array('invoice_id'=>$fid));
		$fb->request();
		if ($fb->success()) {
			$result = $fb->getResponse();
			$this->redirect($result['invoice']['links']['client_view']);
		} else {
			$this->Session->setFlash('Error opening page: '.$fb->getError());
			$this->redirect('/vendors/manage');
		}
	}
	
	public function run_bill(){
		$userInfo = $this->Auth->user();
		$c = $this->Company->findById($userInfo['User']['company_id']);
		$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		
		$run = '1';
		if ($run=='1') {
				$start = date('n/j/y',strtotime("-1 week"));
				$end = date('n/j/y',strtotime("now"));
				$num = 0;
				$fbc = 0;
				
				$vn = $this->Vendor->find('all');
				foreach ($vn as $v) {
					$this->Record->recursive = 2;
					$records = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.bill_id'=>null,'Record.vendor_id'=>$v['Vendor']['id'],'Record.created >'=>date('Y-m-d', strtotime("March 5, 2012")))));
					if (count($records)>0) {
						
						//create the bill
						$this->Bill->create();
						$d = array();
						$d['Bill']['vendor_id'] = $v['Vendor']['id'];
						$d['Bill']['week_start'] = $start;
						$d['Bill']['week_end'] = $end;
						$d['Bill']['end_timestamp'] = strtotime("-1 week");
						$d['Bill']['leads'] = count($records);
						$d['Bill']['total'] = $s['Setting']['lead_price']*count($records);
						$this->Bill->save($d);
						$bill_id = $this->Bill->getLastInsertId();
						$this->Bill->id = false;
						
						foreach ($records as $r) {
							$this->Record->id = $r['Record']['id'];
							$this->Record->saveField('bill_id',$bill_id);
							$this->Record->id = false;
						}
						
						$this->Vendor->id = $v['Vendor']['id'];
						$this->Vendor->saveField('total_bill','0');
						$this->Vendor->id = false;
						
						$num++;
						
						if ($s['Setting']['use_freshbooks']=='1'&&$v['Vendor']['freshbooks_id']!='') {
							require('/home/lcarrier/public_html/app/webroot/freshbooks_api/FreshBooksRequest.php');
							
							$domain = $s['Setting']['freshbooks_url'];
							$token = $s['Setting']['freshbooks_api_token'];
		
							FreshBooksRequest::init($domain, $token);
							
							$fb = new FreshBooksRequest('invoice.create');
							// Any arguments you want to pass it
							/*$fb->post(array('invoice'=>array(
								'client_id'=>$v['Vendor']['freshbooks_id'],
								'lines'=>array(
									'line'=>array(
										'name'=>'Leads Generated',
										'description'=>$start.' to '.$end,
										'unit_cost'=>$s['Setting']['lead_price'],
										'quantity'=>$v['Vendor']['total_bill']
									)
								 )
								)
							));*/
							$fb->post(array('invoice'=>array(
								'client_id'=>$v['Vendor']['freshbooks_id']
								)
							));
							
							// Make the request
							$fb->request();
							if($fb->success())
							{
								$result = $fb->getResponse();
								$id = $result['invoice_id'];
								
								$add_errors = '';
								foreach ($records as $r) {
									FreshBooksRequest::init($domain, $token);
									$fb = new FreshBooksRequest('invoice.lines.add');
									$fb->post(array(
										'invoice_id'=>$id,
										'lines'=>array(
											'line'=>array(
												'name'=>'Lead',
												'description'=>date('Y-m-d',strtotime($r['Record']['created'])).': '.$r['Client']['first_name'].' '.$r['Client']['last_name'],
												'unit_cost'=>$s['Setting']['lead_price'],
												'quantity'=>'1'
											)
										)
										)
									);
									$fb->request();
									if(!$fb->success()) {
										$add_errors += $fb->getError()+'\n';
									}
								}
								if ($add_errors!='') {
									//$this->out($c['Company']['name'].'('.$c['Company']['id'].'): Adding Items to Invoice Failed - '.$add_errors);
								}
								
								$this->Bill->id = $bill_id;
								$this->Bill->saveField('freshbooks_invoice_id',$id);
								$this->Bill->id = false;
								
								$fbc++;		
							} else {
							    //$this->out($c['Company']['name'].'('.$c['Company']['id'].'): Invoice Creation Failed - '.$fb->getError());
							    $id = '';	
							}
						} else {
							$id = '';
						}
					}
				}
			
				if ($s['Setting']['use_freshbooks']=='1') {
					$add = ' Freshbooks invoices generated for '.$fbc.' Vendors.';
				} else {
					$add = '';
				}
				$this->Session->setFlash('Bills Generated. '.$add);
				$this->redirect('dashboard');
			}
	}
}
?>