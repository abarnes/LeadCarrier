<?php
class Category extends AppModel {
    var $name = 'Category';
    var $useDbConfig = 'new';
    var $hasMany = array('Range'=>array('dependent'=>true),'Record'=>array('dependent'=>true),'Vendor'=>array('dependent'=>true));
    /*var $hasAndBelongsToMany = array(
        'Vendor' =>
            array(
                'className'              => 'Vendor',
                'joinTable'              => 'categories_vendors',
                'foreignKey'             => 'category_id',
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
    );*/
    
}
?>