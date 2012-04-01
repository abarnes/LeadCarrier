<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Field extends AppModel {
    var $name = 'Field';
    var $useDbConfig = 'new';
    public $validate = array(
        'name' => array(
            'Rule-1' => array(
                'rule'    => 'isUnique',
                'message' => 'This field name has already been used.',
                'last'    => true
             ),
            'Rule-2' => array(
                'rule'    => array('minLength', 1),
                'message' => 'This field cannot be left blank.'
            ),
            'Rule-3' => array(
                'rule'    => array('sql_reserved'),
                'message' =>'May not be set to any of the following: "text", "decimal", "varchar", "date", "datetime", "tinyint", "check", or "int".'
            ),
            'Rule-4'=>array(
                'rule'=>'alphaNumeric',
                'message'=>'The name may only contain letters and numbers.'
            )
        ),
        'display_name' => array(
            'rule'    => 'notEmpty',
            'message' => 'This field cannot be left blank.'
        )
    );
    
    function sql_reserved ($check) {
        $forbidden = array("text","decimal","varchar","date","datetime","tinyint","int","check");
        if (in_array($check['name'],$forbidden)) {
            return false;
        } else {
            return true;
        }
    }
}
?>