<?php
class ApisController extends AppController {
 
	var $name = 'Apis';
        var $layout = 'admin';
	var $uses = array('Category','Record','Setting','Client','Range','Company','Field');
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
				die('Error: failed to validate API token.  Please check that it is correct and try again.');
			}
		} else {
			die('Error: failed to find company by the name"'.$vars['company_name'].'"');
		}
	    } else {
		die('Error: no POST variables set.');
	    }
        }
        
	//parses client information and selections at once
	public function parse_all() {

		$vars = $_POST;
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		
		$this->Client->create();
		$data = array();
		foreach ($vars as $row=>$value) {
			$data['Client'][$row] = $value;
		}
		
		$data = array();
		foreach ($vars as $row=>$value) {
			if (substr($row,0,1)=='I') {
				$data['Client'][substr($row,0)] = $value;
			}
		}
		
		if ($this->Client->save($data)) {
			$id = $this->Client->getLastInsertID();
			foreach ($vars as $row=>$value) {
				if (substr($row,0,1)=='c') {
					$f = $this->Category->findById(substr($row,1));
					
					$i = 1;
					while($i<=$s['Setting']['leads_per_industry']){
						$this->Category->Record->create();
						$data = array();
						$data['Record']['client_id'] = $id;
						$data['Record']['category_id'] = substr($row,1);
						if ($f['Category']['use_ranges']=='1') {
							if ($value==false) {
								$data['Record']['select'] = '0';
							} else {
								$data['Record']['range_id'] = $this->request->data['Category']['v'.substr($row,1)];
								$data['Record']['select'] = '1';
							}
						} else {
							$data['Record']['select'] = $value;
						}
						
						$this->Category->Record->save($data);
						$this->Category->Record->id = false;
						$i++;
					}
				}
			}
			echo 'done';
		} else {
			echo 'Error: failed to save information.';
		}
		
	}
	
	//parses client information and returns an ID, which is then used in parse_selections()
	public function parse_info() {
		$vars = $_POST;
		
		$this->Client->create();
		$data = array();
		foreach ($vars as $row=>$value) {
			if (substr($row,0,1)=='I') {
				$data['Client'][substr($row,0)] = $value;
			}
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
			$vars = $_POST;
			$id = $vars['id'];
			if ($id!='') {
				$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
				foreach ($vars as $row=>$value) {
					if (substr($row,0,1)=='c') {
						$f = $this->Category->findById(substr($row,1));
						
						$i = 1;
						while($i<=$s['Setting']['leads_per_industry']){
							$this->Category->Record->create();
							$data = array();
							$data['Record']['client_id'] = $id;
							$data['Record']['category_id'] = substr($row,1);
							if ($f['Category']['use_ranges']=='1') {
								if ($value==false) {
									$data['Record']['select'] = '0';
								} else {
									$data['Record']['range_id'] = $this->request->data['Category']['v'.substr($row,1)];
									$data['Record']['select'] = '1';
								}
							} else {
								$data['Record']['select'] = $value;
							}
							
							$this->Category->Record->save($data);
							$this->Category->Record->id = false;
							$i++;
						}
					}
				}
				echo 'done';
			} else {
				echo 'No ID set.';
			}
	}
	
	//returns fields for client info
	public function get_fields() {
		$fields = $this->Field->find('all');
		echo json_encode($fields);
	}
	
	//returns data for selection form (industries & their ranges)
	public function get_selections() {
		$this->Category->recursive = 1;
		echo json_encode($this->Category->find('all',array('conditions'=>array('Category.enable'=>'1'))));
	}
	
}
?>