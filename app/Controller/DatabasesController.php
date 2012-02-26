<?php
class DatabasesController extends AppController {
 
	var $name = 'Companies';
	var $uses = array('Company','User','Database');
	public $components = array(
		'Session',
		'Password',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        public function beforeFilter() {
		$this->Auth->allow('db_setup');
        }
	
	
	public function db_setup($company_id){
		$c = $this->Company->findById($company_id);		
		if (empty($c)) {
			$this->Session->setFlash('Error creating database: failed to find company.');
			$this->redirect('/');
		}
				
		$company = $c['Company']['name'];
		$uname = 'lcarrier_'.substr(str_replace(" ", "", $company),0,7);
		$p = $this->Password->__randomPassword();

		$create_db = 'CREATE DATABASE '.$uname.";";
		$create_user = "CREATE USER '".$uname."'@'localhost' IDENTIFIED BY '".$p."';";
		$grant = "GRANT All ON ".$uname.".* TO '".$uname."'@'localhost' WITH GRANT OPTION;";
		
		//try {
			$this->Database->query($create_db);
		//} catch (Exception $e) {
		//	die(print('Caught exception: '.$e->getMessage()));
		//}
		$this->Database->query($create_user);
		$this->Database->query($grant);
		
		$this->Database->newdb($uname,$p);
			$this->Company->id = $company_id;
			$d = array();
			$d['Company']['db_name'] = $uname;
			$d['Company']['db_password'] = $p;
			if ($this->Company->save($d,false)) {
				$this->Session->setFlash('Database created for '.$c['Company']['name']);
				$this->redirect('/users/add/'.$company_id);
			} else {
				$this->Session->setFlash('Error saving company.  Please try again later.');
				$this->redirect('/');		
			}
	}
	
	public function test($company_id) {
		$this->Company->id = $company_id;
			$d = array();
			$d['Company']['db_name'] = 'dsafd';
			$d['Company']['db_password'] = 'dfdf';
			$this->Company->save($d,false);
	}
    
}

?>