<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Vendor extends AppModel {
    var $name = 'Vendor';
    //var $belongsTo = array('Category');
    var $useDbConfig = 'new';
    var $hasMany = array('Record','Bill');
    var $hasAndBelongsToMany = array(
        'Range' =>
            array(
                'className'              => 'Range',
                'joinTable'              => 'ranges_vendors',
                'foreignKey'             => 'vendor_id',
                'associationForeignKey'  => 'range_id',
                'unique'                 => true,
                'conditions'             => '',
                'fields'                 => '',
                'order'                  => '',
                'limit'                  => '',
                'offset'                 => '',
                'finderQuery'            => '',
                'deleteQuery'            => '',
                'insertQuery'            => ''
            ),
        'Category' =>
            array(
                'className'              => 'Category',
                'joinTable'              => 'categories_vendors',
                'foreignKey'             => 'vendor_id',
                'associationForeignKey'  => 'category_id',
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
        'name' => array(
            'rule'=>'notEmpty',
            'message'=>'Please provide the vendor\'s name.'
        ),
        'email' => array(
            'rule'=>'email',
            'message'=>'Please provide a valid email address.'
        )
    );
}
?>