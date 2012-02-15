<?php 
class Company extends AppModel {
    var $name = 'Company';
    var $hasMany = array('User');
    var $validate = array(
        'name' => array(
            'rule' => 'isUnique',
            'message' => 'This company name has already been taken.',
            'required'=>true,
            'allowEmpty'=>false
        )
    );
    
}
?>