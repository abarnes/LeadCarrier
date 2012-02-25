<?php
class BillShell extends Shell {
	var $uses = array('Vendor','Bill','Setting','Company');
	//var $tasks = array('Email');
	//var $Email;

	public function main() {
		$companies = $this->Company->find('all',array('conditions'=>array('Company.active'=>'1')));
		foreach ($companies as $c) {
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
			
			$s = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
			$start = date('n/j/y',strtotime("-1 week"));
			$end = date('n/j/y',strtotime("now"));
			$num = 0;
			
			$vn = $this->Vendor->find('all',array('conditions'=>array('Vendor.total_bill >'=>'0')));
			foreach ($vn as $v) {
				$this->Bill->create();
				$d = array();
				$d['Bill']['vendor_id'] = $v['Vendor']['id'];
				$d['Bill']['week_start'] = $start;
				$d['Bill']['week_end'] = $end;
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
		$this->out($c['Company']['name'].': bills Generated for '.$num.' vendors.');
	}
		
}
?>