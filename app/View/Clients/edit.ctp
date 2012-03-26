<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<h4>Edit Client</h4>
<div style="width:60%;">
    
    <div class="label">
    <?php echo $this->Form->create('Client', array('action' => 'edit/'.$id)); ?>
    <?php echo $this->Form->input('first_name', array( 'label' => 'First Name')); ?>
    <?php echo $this->Form->input('last_name', array( 'label' => 'Last Name')); ?>
    <?php echo $this->Form->input('phone', array( 'label' => 'Phone')); ?>
    <?php echo $this->Form->input('email', array( 'label' => 'Email')); ?>
    <?php echo $this->Form->input('zip', array( 'label' => 'Zip Code')); ?>
    <?php echo $this->Form->input('wedding_date', array( 'label' => 'Wedding Date')); ?>
    <?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $this->Form->end('Submit'); ?>
    </div>

</div>
    