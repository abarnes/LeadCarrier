<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class AffiliatesController extends AppController {
 
	var $name = 'Affiliates';
        var $layout = 'admin';
	var $helpers = array('Html', 'Form');
	var $uses = array('Company','Affiliate');
	public $components = array(
		'Session',
		'Password',
		'Email',
		'Cookie',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
	public function beforeFilter() {
		    $allow = array('check');
		    if ($this->Auth->user('id')==null && !in_array($this->params['action'],$allow)) {
			    $this->Session->setFlash('You are not authorized to view that page.');
			    $this->redirect('/login');
		    }
		    
		    parent::beforeFilter();
		    $this->Auth->allow('check');
	}
	
	public function index() {
		$this->set('affiliates',$this->Affiliate->find('all'));
	}
	
	public function add() {
		if (!empty($this->data)) {
			$link = $this->Password->__randomPassword('12');
			while ($this->Affiliate->find('count',array('conditions'=>array('Affiliate.link'=>$link)))>0) {
				$link = $this->Password->__randomPassword('12');
			}
			$this->request->data['Affiliate']['link'] = $link;
			if ($this->Affiliate->save($this->request->data)) {
				$this->Session->setFlash('Affiliate network saved.');
				$this->redirect('/affiliates');
			} else {
				$this->Session->setFlash('Error: failed to save.');
			}
		}
	}
	
	public function edit($id) {
		$this->Affiliate->id = $id;
		if (empty($this->request->data)) {
			$this->request->data = $this->Affiliate->read();
			$this->set('id',$id);
		} else {
			if ($this->Affiliate->save($this->request->data)) {
				$this->Session->setFlash('Affiliate network saved.');
				$this->redirect('/affiliates');
			} else {
				$this->Session->setFlash('Error: failed to save.');
			}
		}
	}
	
	public function view($id) {
		$this->set('a',$this->Affiliate->findById($id));
	}
	
	public function delete($id) {
		if ($this->Affiliate->delete($id,false)) {
			$this->Session->setFlash('Affiliate network deleted.');
			$this->redirect('/affiliates');
		} else {
			$this->Session->setFlash('Error: failed to delete.');
			$this->redirect('/affiliates');
		}
	}
	
	public function submit() {
			if (!empty($this->request->data)) {
			switch ($this->request->data['Affiliate']['action']) {
				case 'delete':
					//delete code
					foreach ($this->request->data['Affiliate'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->Affiliate->delete(substr($row,5));
							}
						}
					}
					$this->redirect('/affiliates');
					break;
				case 'edit':
					//edit code
					foreach ($this->request->data['Affiliate'] as $row=>$value) {
						if ($row!='action') {
							if ($value=='1') {
								$this->redirect('/affiliates/edit/'.substr($row,5));
							}
						}
					}
					break;
				default:
					$this->redirect('/affiliates');
					break;
			}
			$this->redirect('/affiliates');
		} else {
			$this->redirect('/affiliates');
		}
	}
	
	public function check($code) {
		$find = $this->Affiliate->findByLink($code);
		if (!empty($find)) {
			$this->Cookie->write('referral', $find['Affiliate']['id'], false,'1 day');
			$this->redirect('/');
		}
	}

}
?>