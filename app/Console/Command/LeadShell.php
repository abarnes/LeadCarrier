<?php
class LeadShell extends Shell {
	var $uses = array('Vendor','Setting','Company','Record','Client');
	var $tasks = array('Email');
	//var $Email;
	
	function startup() {
		$this->Email->settings(array(
		    'subject' => 'Test'
		));
	    }
	
	public function main() {
		$companies = $this->Company->find('all',array('order'=>'Company.id ASC','conditions'=>array('Company.active'=>'1','Company.id !='=>'1')));
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
			
			$records = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'0','Record.vendor_id !='=>'')));
			
			foreach ($records as $r) {
				$vendor = $this->Vendor->findById($r['Record']['vendor_id']);
				$client = $this->Client->findById($r['Record']['client_id']);
				
				$this->Email->set('name',$s['Setting']['site_url']);
				$this->Email->set('c',$client);
				if ($range!=null) {
					$r = $this->Range->findById($range);
					$this->Email->set('rr','Price Range: '.$r['Range']['name']);
				} else {
					$this->Email->set('rr','');
				}
				
				// Let the vendor know
				$opts = array();	
				$opts['to'] = $v['Vendor']['email'];
				$opts['subject'] = 'Lead from '.$s['Setting']['site_url'];
				//$this->Email->replyTo = $s['Setting']['replyto_email'];
				$opts['from'] =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
				$opts['template'] = 'lead'; 
				$opts['sendAs'] = 'both';
				$this->Email->send($opts);
				
				$this->Record->id = $r['Record']['id'];
				$this->Record->saveField('sent','1');
				$this->Record->id = false;
				
				$this->out($c['Company']['name'].': Lead Sent to '.$vendor['Vendor']['name'].' (id #'.$client['Client']['id'].')');
			}
		}
	}
}
?>