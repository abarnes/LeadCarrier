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
}
?>