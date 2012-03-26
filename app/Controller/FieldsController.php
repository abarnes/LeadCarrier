<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class FieldsController extends AppController {
 
	var $name = 'Fields';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Field','Setting','Client');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        function beforeFilter() {
		$allow = array();
		if ($this->Auth->user('id')==null && !in_array($this->params['action'],$allow)) {
			$this->Session->setFlash('You are not authorized to view that page.');
			$this->redirect('/login');
		}
		
		parent::beforeFilter();
		$this->Auth->allow();
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	
	public function index () {
		$this->layout = 'admin';
		$this->Field->recursive = 2;
		$fields = $this->Field->find('all');
		$this->set(compact('fields'));
	}
	
		//handles submissions from manage page
	public function submit() {
		//die(print_r($this->request->data));
		if (!empty($this->request->data)) {
			switch ($this->request->data['Field']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['field'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Field->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/settings');
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Field'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/fields/edit/'.substr($row,5));
							}
						}
					}
					break;
				default:
					$this->redirect('/settings');
					break;
			}
			$this->redirect('/settings');
		} else {
			$this->redirect('/settings');
		}
	}
	
	public function add() {
		$this->layout = 'admin';
		if (!empty($this->request->data)) {
			if ($this->Field->save($this->request->data)) {
				//alter the database
				switch ($this->request->data['Field']['type']) {
					case 'varchar':
						$v = 'varchar (255)';
						break;
					case 'text':
						$v = 'text';
						break;
					case 'int':
						$v = 'int (11)';
						break;
					case 'tinyint':
						$v = 'tinyint (1)';
						break;
					case 'date':
						$v = 'date';
						break;
					case 'datetime':
						$v = 'datetime';
						break;
					case 'decimal':
						$v = 'decimal(10,4) DEFAULT NULL';
						break;
					default:
						$v = 'varchar (255)';
						break;
				}

				$q = 'alter table clients add column '.$this->request->data['Field']['name'].' '.$v.';';
				$this->Client->query($q);		
				Cache::clear();
					$this->Session->setFlash('Field "'.$this->request->data['Field']['name'] . '" Successfully Added.');
					$this->redirect(array('controller'=>'settings','action' => 'index'));	
			} 	
		}
	}
    
	/*function edit($id) {
		$this->layout = 'admin';
		$this->set('field',$this->Field->findById($id));
		$this->Field->id = $id;
		if (empty($this->request->data)) {
			$this->request->data = $this->Field->read();
		} else {
			if ($this->Field->save($this->request->data)) {
				$this->Session->setFlash('Field has been updated.');
				$this->redirect(array('controller'=>'settings','action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			}
		}
	}*/
	
	public function toggle_display($id) {
		$this->Field->id = $id;
		$f = $this->Field->findById($id);
		if ($f['Field']['display']=='1') {
			$v = '0';
		} else {
			$v = '1';
		}
		$this->Field->saveField('display',$v);
		$this->Session->setFlash('Field display changed.');
		$this->redirect(array('controller'=>'settings','action'=>'index'));
	}
    
	public function delete($id) {
		$f = $this->Field->findById($id);
		$q = 'alter table clients drop column '.$f['Field']['name'].';';
		$this->Client->query($q);
		Cache::clear();
		$this->Field->delete($id,true);
		$this->Session->setFlash('Field successfully deleted.');
		$this->redirect(array('controller'=>'settings','action'=>'index'));
	}
    
}

?>