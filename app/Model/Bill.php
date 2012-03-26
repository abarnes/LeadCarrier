<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Bill extends AppModel {
    var $name = 'Bill';
    var $belongsTo = array('Vendor');
    var $hasMany = array('Record');
    var $useDbConfig = 'new';
}
?>