<?php
class BillShell extends Shell {
	var $uses = array('Vendor','Bill','Setting','Company');
	//var $tasks = array('Email');
	//var $Email;

	public function main() {
		$companies = $this->Company->find('all',array('order'=>'Company.id ASC','conditions'=>array('Company.active'=>'1','Company.id !='=>'1')));
		foreach ($companies as $c) {
			$this->out($c['Company']['name'].'('.$c['Company']['id'].'): started.');
			$connect = array('db_name'=>$c['Company']['db_name'],'db_password'=>$c['Company']['db_password']);
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
					ConnectionManager::create('new', $a);
			}
			$this->out($c['Company']['name'].'('.$c['Company']['id'].'): connected.');
			
			$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
			$start = date('n/j/y',strtotime("-1 week"));
			$end = date('n/j/y',strtotime("now"));
			$num = 0;
			$fbc = 0;
			
			$vn = $this->Vendor->find('all');
			foreach ($vn as $v) {
				$records = $this->Record->find('all',array('conditions'=>array('Vendor.bill_id'=>null,'Record.vendor_id'=>$v['Vendor']['id'])));
				if (count($records)>0) {
					
					//create the bill
					$this->Bill->create();
					$d = array();
					$d['Bill']['vendor_id'] = $v['Vendor']['id'];
					$d['Bill']['week_start'] = $start;
					$d['Bill']['week_end'] = $end;
					$d['Bill']['freshbooks_invoice_id'] = $id;
					$d['Bill']['end_timestamp'] = strtotime("-1 week");
					$d['Bill']['leads'] = count($records);
					$d['Bill']['total'] = $s['Setting']['lead_price']*count($records);
					$this->Bill->save($d);
					$bill_id = $this->Bill->getLastInsertId();
					$this->Bill->id = false;
					
					$lines = array();
					foreach ($records as $r) {
						$this->Record->id = $r['Record']['id'];
						$this->Record->saveField('bill_id',$bill_id);
						$this->Record->id = false;
						
						$lines = $lines+array('line',array('name'=>'Lead','unit_cost'=>$s['Setting']['lead_price'],'quantity'=>'1','description'=>date('Y-m-d',strtotime($r['Record']['created']))));
					}
					
					$this->Vendor->id = $v['Vendor']['id'];
					$this->Vendor->saveField('total_bill','0');
					$this->Vendor->id = false;
					
					$num++;
					
					if ($c['Company']['use_freshbooks']=='1'&&$v['Vendor']['freshbooks_id']!='') {
						require('/home/lcarrier/public_html/app/webroot/freshbooks_api/FreshBooksRequest.php');
						
						$domain = $c['Company']['freshbooks_url'];
						$token = $c['Company']['freshbooks_api_token'];
	
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
							'client_id'=>$v['Vendor']['freshbooks_id'],
							'lines'=>$lines
							)
						));
						
						// Make the request
						$fb->request();
						if($fb->success())
						{
							$result = $fb->getResponse();
							$id = $result['invoice_id'];
							
							$this->Bill->id = $bill_id;
							$this->Bill->saveField('freshbooks_invoice_id',$id);
							$this->Bill->id = false;
							
							$fbc++;		
						} else {
						    $this->out($c['Company']['name'].'('.$c['Company']['id'].'): Invoice Creation Failed - '.$fb->getError());
						    $id = '';	
						}
					} else {
						$id = '';
					}
				}
			}
		}
		
		if ($c['Company']['use_freshbooks']=='1') {
			$add = ' Freshbooks Invoices Generate for '.$fbc.' Vendors.';
		} else {
			$add = '';
		}
		$this->out($c['Company']['name'].'('.$c['Company']['id'].'): bills Generated for '.$num.' vendors.'.$add);
	}
		
}
?>