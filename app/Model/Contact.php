<?php 
class Contact extends AppModel {
    var $name = 'Contact';
    var $useTable = false;
    var $validate = array(
        'email' => array(
            'rule' => array('email', true),
            'message' => 'Please supply a valid email address.'
        ),
        'name' => array(
            'rule' => array('minLength', '1'),
            'message' => 'Please supply your name.'
        ),
        'message' => array(
            'rule' => array('minLength', '1'),
            'message' => 'The message cannot be blank'
        )
    );
}
?>