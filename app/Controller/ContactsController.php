<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
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
		if (!empty($this->request->data)) {
			$this->Contact->set($this->request->data);
			if ($this->Contact->validates()) {
				$this->set('d',$this->request->data['Contact']);
					
				$this->Email->to = 'info@leadcarrier.com';
				$this->Email->subject = 'Message Submitted by '.$this->request->data['Contact']['name'];
				$this->Email->replyTo = $this->request->data['Contact']['email'];
				$this->Email->from =  'Lead Carrier <info@leadcarrier.com>';
				$this->Email->template = 'contactform'; 
				$this->Email->sendAs = 'both';
				$this->Email->send();		
				
				$this->Session->setFlash('Thank you! Your message has been submitted.');
				$this->redirect('/contact');
			} else {
				$errors = $this->Contact->validationErrors;
			}
		}
	}
}

?>