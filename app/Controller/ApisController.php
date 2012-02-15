<?php
class ApisController extends AppController {
 
	var $name = 'Apis';
        var $layout = 'admin';
	var $uses = array('Category','Record','Setting','Client','Range','Company');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        public function beforeFilter() {
	    //parent::beforeFilter();
	    $this->autoRender = false;
	    
            $this->Auth->allow('*');
	    //establish DB connection based on posted credentials
	    $vars = $_POST;	    
	    if (isset($vars['company_name'])&&isset($vars['api_token'])) {
		$c = $this->Company->findByName($vars['company_name']);
		if (!empty($c)) {
			if ($c['Company']['api_token']==$vars['api_token']) {
				    @App::import('ConnectionManager');
				    $a = array(
					    'datasource' => 'Database/Mysql',
					    'persistent' => false,
					    'host' => 'localhost',
					    'login' => $c['Company']['db_name'],
					    'password' => $c['Company']['db_password'],
					    'database' => $c['Company']['db_name'],
					    'prefix' => '');
				    try {
					    ConnectionManager::create('new', $a);
				    } catch (MissingDatabaseException $e) {
					    echo 'DB error: '.$e->getMessage();
				    }
			} else {
				echo 'Error: failed to validate API token.  Please check that it is correct and try again.';
			}
		} else {
			echo 'Error: failed to find company by the name"'.$vars['company_name'].'"';
		}
	    } else {
		echo 'Error: no POST variables set.';
	    }
        }
        
	//parses client information and selections at once
	public function parse_all() {

	}
	
	//parses client information and returns an ID, which is then used in parse_selections()
	public function parse_info() {
		$vars = $_POST;
		
		$this->Client->create();
		$data = array();
		foreach ($vars as $row=>$value) {
			$data['Client'][$row] = $value;
		}
		if ($this->Client->save($data)) {
			echo $this->Client->getLastInsertID();
		} else {
			echo 'Error: failed to save information.';
		}
		//die(print_r($_POST));
	}
	
	//parses client selections after the information has been submitted with parse_info()
	public function parse_selections() {
		
	}
	
	//returns data for selection form (industries & their ranges)
	public function get_form() {
		
	}
}

?>