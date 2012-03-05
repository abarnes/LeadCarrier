<?php 
class Bill extends AppModel {
    var $name = 'Bill';
    var $belongsTo = array('Vendor');
    var $hasMany = array('Record');
    var $useDbConfig = 'new';
}
?>