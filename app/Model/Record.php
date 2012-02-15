<?php 
class Record extends AppModel {
    var $name = 'Record';
    var $belongsTo = array('Vendor','Client','Category');
    var $useDbConfig = 'new';
}
?>