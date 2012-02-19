<?php
class CategoriesController extends AppController {
 
	var $name = 'Categories';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Category','Range','Record','Client','RangesVendor','Setting');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        function beforeFilter() {
	    parent::beforeFilter();
            $this->Auth->allow('view','select');
	    
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
		//$this->Category->setDataSource('new');
		//$this->Range->setDataSource('new');
		$this->Client->setDataSource('new');
		$this->Record->setDataSource('new');
		$this->RangesVendor->setDataSource('new');
	    }*/
	    $this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	
	function index () {
		$this->layout = 'admin';
		$this->Category->recursive = 2;
		$cats = $this->Category->find('all');
		$this->set(compact('cats'));
	}
	
		//handles submissions from manage page
	function submit() {
		//die(print_r($this->request->data));
		if (!empty($this->request->data)) {
			switch ($this->request->data['Category']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Category'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Category->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/industries');
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Category'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/categories/edit/'.substr($row,5));
							}
						}
					}
					break;
				case 'ranges':
					//edit code
					foreach ($this->request->data['Category'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/ranges/index/'.substr($row,5));
							}
						}
					}
					break;
				default:
					$this->redirect('/industries');
					break;
			}
			$this->redirect('/industries');
		} else {
			$this->redirect('/industries');
		}
	}
	
	function add() {
		$this->layout = 'admin';
		$this->set('down','industries');
		if (!empty($this->request->data)) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('"'.$this->request->data['Category']['name'] . '" Successfully Added.');
				if ($this->request->data['Category']['use_ranges']=='1') {
					$i = $this->Category->getLastInsertID();
					$this->redirect(array('controller'=>'ranges','action' => 'add/'.$i));
				} else {
					$this->redirect(array('controller'=>'categories','action' => 'index'));
				}
			} else {
				$this->Session->setFlash('Error: Failed to Save Industry');
			}
		}
	}
	
	function select($id){
		$this->set('id',$id);
		$this->Category->recursive = 2;
		$this->set('categories',$this->Category->find('all',array('conditions'=>array('Category.enable'=>'1'))));
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		if (!empty($this->request->data)) {
			//die(print_r($this->request->data));
			foreach ($this->request->data['Category'] as $row=>$value) {
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
			//$this->Session->setFlash('Thank you! You will receive your quotes soon.');
			$this->redirect(array('controller'=>'pages','action' => 'thankyou'));
		}
	}
    
	function edit($id) {
		$this->layout = 'admin';
		$this->set('category',$this->Category->findById($id));
		$this->Category->id = $id;
		if (empty($this->request->data)) {
			$this->request->data = $this->Category->read();
		} else {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash('Industry has been updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}
    
	function delete($id) {
		$this->Category->delete($id,true);
		$this->Session->setFlash('Industry successfully deleted.');
		$this->redirect(array('action'=>'index'));
	}
    
}

?>