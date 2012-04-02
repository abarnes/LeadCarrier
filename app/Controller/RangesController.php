<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class RangesController extends AppController {
 
	var $name = 'Ranges';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Range','Client','Category');
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
		$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
        }
        
	
	function index ($id) {
		$this->set('id',$id);
		$this->layout = 'admin';
		$this->set('down','industries');
		$r = $this->Range->Category->findById($id);
		if ($r['Category']['use_ranges']=='0') {
			$this->Session->setFlash('This industry does not use price ranges.');
			$this->redirect('/industries');
		}
		$this->set('r',$r);
		
		//$this->set('ranges', $this->Range->Vendor->find('list'));
		$ranges = $this->Range->find('all',array('order'=>'Range.low_end ASC','conditions'=>array('Range.category_id'=>$id)));
		$this->set(compact('ranges'));
	}
	
	function add($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		$this->set('r',$this->Range->find('all',array('conditions'=>array('Range.category_id'=>$id))));
		
		$this->set('id',$id);
		$n = $this->Range->Category->findById($id);
		$this->set('name',$n['Category']['name']);
		//$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		if (!empty($this->request->data)) {
			$this->request->data['Range']['category_id']=$id;
			if ($this->Range->save($this->request->data)) {
				$this->Session->setFlash('Price Range Successfully Added.');
				$find = $this->Range->find('first',array('conditions'=>array('Range.low_end'=>$this->request->data['Range']['low_end']),'order'=>array('Range.created DESC')));
				$this->redirect(array('controller'=>'ranges','action' => 'select/'.$find['Range']['id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save Price Range');
			}
		}
	}
	
	function select($id) {
		$this->layout = 'admin';
		$this->set('down','industries');
		
		$this->Range->id = $id;
		$this->set('id',$id);
		$r = $this->Range->findById($id);
		$this->set('name',$r['Range']['name']);
		
		$v = $this->Range->Vendor->find('list',array('conditions'=>array('Vendor.category_id'=>$r['Range']['category_id']),'order'=>array('Vendor.name ASC')));
		if (count($v)==0) {
			$this->Session->setFlash('Price range set.  Add more, or skip ahead and add vendors.');
			$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
		}
		$this->set('vendors',$v);
		$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		if (empty($this->request->data)) {
			$this->request->data = $this->Range->read();
		} else {
			if ($this->Range->save($this->request->data)) {
				$this->Session->setFlash('Vendors Set.');
				$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function edit($id) {
		$this->layout = 'admin';
		$this->set('id',$id);
		$r = $this->Range->findById($id);
		$this->set('range',$r);
		
		$v = $this->Range->Vendor->find('list',array('conditions'=>array('Vendor.category_id'=>$r['Range']['category_id']),'order'=>array('Vendor.name ASC')));
		$this->set('vendors',$v);
		//$this->set('categories', $this->Range->Category->find('list',array('order'=>'Category.name ASC','conditions'=>array('Category.use_ranges'=>'1'))));
		
		$this->Range->id = $id;
		if (empty($this->request->data)) {
			$this->request->data = $this->Range->read();
		} else {
			if ($this->Range->save($this->request->data)) {
				$this->Session->setFlash('Range Has Been Updated.');
				$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function delete($id) {
		$r = $this->Range->findById($id);
		$this->Range->delete($id);
		$this->Session->setFlash('Range Successfully Deleted.');
		$this->redirect(array('action'=>'index/'.$r['Range']['category_id']));
	}
	
	//handles submissions from manage page
	function submit($id) {
		if (!empty($this->request->data)) {
			switch ($this->request->data['Range']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Range'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Range->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/ranges/index/'.$id);
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Range'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/ranges/edit/'.substr($row,5));
							}
						}
					}
					break;
				default:
					$this->redirect('/ranges/index/'.$id);
					break;
			}
			$this->redirect('/ranges/index/'.$id);
		} else {
			$this->redirect('/ranges/index/'.$id);
		}
	}
	
}

?>