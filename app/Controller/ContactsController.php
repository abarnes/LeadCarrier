<?php
class ContactsController extends AppController {
 
	var $name = 'Contacts';
        var $layout = 'main';
	var $helpers = array('Html', 'Form');
	public $components = array(
		'Session',
		'Email'
	);
        
        function beforeFilter() {
            $this->Auth->allow('*');
        }
	
	function submit() {
		$this->set('d',$this->request->data['Vendor']);
			
		$this->Email->to = $vendor['Vendor']['email'];
		$this->Email->subject = $this->request->data['Vendor']['subject'];
		$this->Email->replyTo = $s['Setting']['replyto_email'];
		$this->Email->from =  $s['Setting']['site_url'].' <'.$s['Setting']['replyto_email'].'>';
		$this->Email->template = 'message'; 
		$this->Email->sendAs = 'both';
		$this->Email->send();		
		
		$this->Session->setFlash('Email sent to '.$vendor['Vendor']['name']);
		$this->redirect(array('controller'=>'vendors','action'=>'manage'));
		//die(print_r($this->request->data));
	}
}

?>