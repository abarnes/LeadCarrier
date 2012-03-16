<?php 
class Client extends AppModel {
    var $name = 'Client';
    var $useDbConfig = 'new';
    var $hasMany = array('Record'=>array('dependent'=>true));
    /*var $validate = array(
        /*'email' => array(
            'rule' => array('email', true),
            'message' => 'Please Supply A Valid Email Address.'
        ),*//*
        'first_name' => array(
            'rule' => array('minLength', '1'),
            'message' => 'Please supply your first name.'
        ),
        'last_name' => array(
            'rule' => array('minLength', '1'),
            'message' => 'Please supply your last name.'
        ),
        'zip' => array(
            'rule' => array('minLength', '5'),
            'message' => 'Please supply your zip code.'
        ),
        'phone' => array(
            'rule' => array('minLength', '10'),
            'message' => 'Please supply your phone number, including area code.'
        )
    );*/
         
}
?>