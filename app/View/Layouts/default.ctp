<!DOCTYPE html>
<html lang="en">
<head>
<title><?php //echo $title_for_layout?>Lead Carrier</title>
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

<!-- Include external files and scripts here (See HTML helper for more info.) -->
<?php
echo $this->fetch('meta');
echo $this->fetch('css');
echo $this->fetch('script');
?>

<?php //echo $this->Html->Css('style'); ?>
<?php echo $this->Html->Script(array('jquery','jquery.corner','jquery-ui')); ?>

</head>
<body>

<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->

<!-- If you'd like some sort of menu to
show up on all of your views, include it here -->
<div id="header">
    <div id="menu"></div>
</div>

<!-- Here's where I want my views to be displayed -->
<?php echo $this->fetch('content'); ?>

<!-- Add a footer to each displayed page -->
<div id="footer"></div>

</body>
</html>