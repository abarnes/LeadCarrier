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
			
			$vn = $this->Vendor->find('all',array('conditions'=>array('Vendor.total_bill >'=>'0')));
			foreach ($vn as $v) {
				if ($c['Company']['use_freshbooks']=='1'&&$v['Vendor']['freshbooks_id']!='') {
					require('../webroot/freshbooks_api/FreshBooksRequest.php');
					
					$domain = $company['Company']['freshbooks_url'];
					$token = $company['Company']['freshbooks_api_token'];

					FreshBooksRequest::init($domain, $token);
					
					$fb = new FreshBooksRequest('invoice.create');
					// Any arguments you want to pass it
					$fb->post(array('client'=>array(
						'client_id'=>$c['Vendor']['freshbooks_id'],
						'lines'=>array(
							'line'=>array(
								'name'=>'Leads Generated',
								'unit_cost'=>$s['Setting']['lead_price'],
								'quantity'=>$v['Vendor']['total_bill']
							)
						 )
						)
					));
					// Make the request
					$fb->request();
					if($fb->success())
					{
						$fbc++;
						$result = $fb->getResponse();
						$id = $result['invoice_id'];
					}
					else
					{
					    $this->out($c['Company']['name'].'('.$c['Company']['id'].'): Invoice Failed '.$fb->getError());
					    $id = '';	
					}
				} else {
					$id = '';
				}
				
				$this->Bill->create();
				$d = array();
				$d['Bill']['vendor_id'] = $v['Vendor']['id'];
				$d['Bill']['week_start'] = $start;
				$d['Bill']['week_end'] = $end;
				$d['Bill']['freshbooks_invoice_id'] = $id;
				$d['Bill']['end_timestamp'] = strtotime("-1 week");
				$d['Bill']['leads'] = $v['Vendor']['total_bill'];
				$d['Bill']['total'] = $s['Setting']['lead_price']*$v['Vendor']['total_bill'];
				$this->Bill->save($d);
				$this->Bill->id = false;
				
				$this->Vendor->id = $v['Vendor']['id'];
				$this->Vendor->saveField('total_bill','0');
				$this->Vendor->id = false;

				$num++;
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