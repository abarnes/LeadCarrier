<?php
//header ("Expires: Mon, 28 Oct 2008 05:00:00 GMT");
//header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
header ("Content-Disposition: attachment; filename=\"Clients.xls\"" );
header("Content-Type: application/ms-excel");
//header ("Content-Description: Generated Report" );
?>
<?php //echo $content_for_layout ?>
<?php echo $this->fetch('content'); ?>
