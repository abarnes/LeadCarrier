<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<h3>Select Vendors for this Price Range</h3>
<h5><?php echo $name; ?></h5>
    
<div style="width:45%;float:left;">    
    
    <?php echo $this->Form->create('Range', array('action' => 'select/'.$id)); ?>
    <?php //echo $this->Form->input('low_end', array( 'label' => 'Low End')); ?>
    <?php //echo $this->Form->input('high_end', array( 'label' => 'High End')); ?>
    <?php //echo $this->Form->input('category_id', array( 'label' => 'Category')); ?>
    <?php echo $this->Form->input('Vendor', array( 'label' => 'Vendors: <br/>','multiple'=>'checkbox')); ?>
    <?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?><br/>
    <?php echo $this->Form->end('Submit Vendors'); ?>

</div>

<div style="width:55%;float:right;font-size:.8em;">
    
</div>
    