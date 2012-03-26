<?php
/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
class Record extends AppModel {
    var $name = 'Record';
    var $belongsTo = array('Vendor','Client','Category','Bill');
    var $useDbConfig = 'new';
}
?>