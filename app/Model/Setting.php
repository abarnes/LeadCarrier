<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Setting extends AppModel {
    var $name = 'Setting';
    var $useDbConfig = 'new';
    var $validate = array(
        'site_url'=>array(
            'rule1' => array(
                'rule' => 'isUnique',
                'message' => 'This URL has already been registered.',
                'required'=>true,
                'allowEmpty'=>false
            ),
            'rule2'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide your website\'s URL'
            )
        ),
        'from_email'=>array(
            'rule'=>'email',
            'message'=>'Please enter a valid email address.'
        ),
        'replyto_email'=>array(
            'rule'=>'email',
            'message'=>'Please enter a valid email address.'
        ),
        'lead_price'=>array(
            'rule1'=>array(
                'rule'=>array('decimal',2),
                'message'=>'Please set a valid price per lead.'
            ),
            'rule2'=>array(
                'rule'=>array('greaterthan'),
                'message'=>'This field may not be less than zero.'
            )
        ),
        'leads_per_industry'=>array(
            'rule1'=>array(
                'rule'=>array('range',0,11),
                'message'=>'This field must be between 1 and 10'
            )
        )
    );
    
    function greaterthan($check) {
        foreach ($check as $check) {
            if ($check>0) {
                return true;
            } else {
                return false;
            }
        }
    }
    
}
?>