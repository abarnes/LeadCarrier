<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Range extends AppModel {
    var $name = 'Range';
    var $virtualFields = array('name' => 'CONCAT("$",Range.low_end, "-$", Range.high_end)');
    var $belongsTo = array('Category');
    var $useDbConfig = 'new';
    var $hasAndBelongsToMany = array(
        'Vendor' =>
            array(
                'className'              => 'Vendor',
                'joinTable'              => 'ranges_vendors',
                'foreignKey'             => 'range_id',
                'associationForeignKey'  => 'vendor_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            )
    );
    var $validate = array(
        'high_end'=>array(
            'rule2'=>array(
                'rule'=>array('dec'),
                'message'=>'Enter a valid high-end value (no dollar sign $)'
            )
        ),
        'low_end'=>array(
            'rule2'=>array(
                'rule'=>array('dec'),
                'message'=>'Enter a valid low-end value (no dollar sign $)'
            )
        )
    );
    
    function dec($check){
        foreach ($check as $check) {
            if (is_numeric($check)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>