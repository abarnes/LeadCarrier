<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Affiliate extends AppModel {
    var $name = 'Affiliate';
    var $hasMany = array('Company');
    var $validate = array(
        'name' => array(
            'rule1'=>array(
                'rule' => 'isUnique',
                'message' => 'This company name has already been taken.',
            ),
            'rule2'=>array(
                'rule'=>'notEmpty',
                'message'=>'Please provide your company\'s name.'
            )
        )
    );
}
?>