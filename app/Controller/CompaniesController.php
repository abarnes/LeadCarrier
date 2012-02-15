<?php
class CompaniesController extends AppController {
 
	var $name = 'Companies';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('Company');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
        public function beforeFilter() {
		$this->Auth->allow('register');
	    /*$admin = array('admin_index','admin_delete','admin_view');
	    if (in_array(Router::url($this->request->here, true),$admin)) {
		$userInfo = $this->Auth->user();
		if (empty($userInfo)||$userInfo['User']['admin']!='1') {
			$this->Session->setFlash('Access to this page is restricted to system administrators.');
			$this->redirect('/');
		}
	    }*/
        }
	
	public function admin_index () {
		$this->paginate = array(
		     'order' => array('Company.name ASC'),
		    'limit' => 20
		);
		$data = $this->paginate('Company');
		$this->set('companies',$data);
	}
	
	public function register() {
		if (!empty($this->request->data)) {
			if ($this->Company->save($this->request->data)) {
				$this->redirect(array('controller'=>'databases','action' => 'db_setup/'.$this->Company->getLastInsertId()));
			} else {
				$this->Session->setFlash('Error: Registration Failure.  Please try again later.');
			}
		}
	}
    
	public function edit($id) {
		$this->Company->id = $id;
		if (empty($this->request->data)) {
			$this->request->data = $this->Company->read();
		} else {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash('User Information Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			}
		}
	}
	
	public function admin_view($id) {
		
	}
	
	public function admin_delete($id) {
		$this->Company->delete($id);
		$this->Session->setFlash('User Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}
	
}

?>