<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Contact extends AppModel {
    var $name = 'Contact';
    var $useTable = false;
    var $validate = array(
        'email' => array(
            'rule' => array('email', true),
            'message' => 'Please supply a valid email address.'
        ),
        'name' => array(
            'rule'    => array('check_name'),
            'message' => 'Please supply your name.'
        ),
        'message' => array(
            'rule'    => array('check_message'),
            'message' => 'Message cannot be blank.'
        )
    );
    
    function check_name ($check) {
        $forbidden = array("","Name:");
        if (in_array($check['name'],$forbidden)) {
            return false;
        } else {
            return true;
        }
    }
    
    function check_message ($check) {
        $forbidden = array("","Message:");
        if (in_array($check['name'],$forbidden)) {
            return false;
        } else {
            return true;
        }
    }
}
?>