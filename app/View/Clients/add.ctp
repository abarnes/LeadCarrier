<h4>Sign Up (temporary page)</h4>
<div style="width:60%;">
    
    <div class="label">
    <?php echo $this->Form->create('Client', array('action' => 'add')); ?>
    <?php echo $this->Form->input('first_name', array( 'label' => 'First Name')); ?>
    <?php echo $this->Form->input('last_name', array( 'label' => 'Last Name')); ?>
    <?php echo $this->Form->input('phone', array( 'label' => 'Phone')); ?>
    <?php echo $this->Form->input('email', array( 'label' => 'Email')); ?>
    <?php echo $this->Form->input('zip', array( 'label' => 'Zip Code')); ?>
    <?php echo $this->Form->input('wedding_date', array( 'label' => 'Wedding Date')); ?>
    <?php echo $this->Form->end('Submit'); ?>
    </div>

</div>
    