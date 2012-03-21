<?php
class BillsController extends AppController {
 
	var $name = 'Bills';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form');
	var $uses = array('Company','Client','Setting','Bill','Field');
	public $components = array(
		'Session',
		'Password',
		'Email',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
        
	public function beforeFilter() {
		parent::beforeFilter();
	}
	
	public function index() {
		$this->layout = 'vendor';
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']==null||$userInfo['vendor_id']<1) {
			$this->redirect('/dashboard');
		}
		
		$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
		$this->set('unpaid',$unpaid);
		$this->set('count',count($unpaid));
		
		$this->set('bills',$this->Bill->find('all',array('conditions'=>array('Bill.vendor_id'=>$userInfo['vendor_id']))));
	}
	
	public function view($id) {
		$this->layout = 'vendor';
		$bill = $this->Bill->findById($id);
		$userInfo = $this->Auth->user();
		if ($userInfo['vendor_id']!=''&&$userInfo['vendor_id']==$bill['Bill']['vendor_id']) {
			$this->set('bill',$bill);
			
			$unpaid = $this->Bill->find('all',array('conditions'=>array('Bill.paid'=>'0','Bill.vendor_id'=>$userInfo['vendor_id'])));
			$this->set('unpaid',$unpaid);
			$this->set('count',count($unpaid));
			$this->set('fields',$this->Field->find('all',array('conditions'=>array('Field.display'=>'1'))));
		} else {
			$this->Session->setFlash('You do not have permission to view this.');
			$this->redirect('/clients/vendor_view');
		}
	}
	
	public function view_freshbooks_bill($fid) {
		$setting = $this->Setting->find('first',array('order'=>'Setting.created DESC'));
		require('freshbooks_api/FreshBooksRequest.php');
					
		$domain = $setting['Setting']['freshbooks_url'];
		$token = $setting['Setting']['freshbooks_api_token'];
		
		FreshBooksRequest::init($domain, $token);
		$fb = new FreshBooksRequest('invoice.get');
		$fb->post(array('invoice_id'=>$fid));
		$fb->request();
		if ($fb->success()) {
			$result = $fb->getResponse();
			$this->redirect($result['invoice']['links']['client_view']);
		} else {
			$this->Session->setFlash('Error opening page: '.$fb->getError());
			$this->redirect('/vendors/manage');
		}
	}
}
?>