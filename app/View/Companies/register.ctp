<h3>Register</h3>

<br/>
    
    <?php echo $this->Form->create('Company', array('action' => 'register')); ?>
    <?php echo $this->Form->input('name', array( 'label' => 'Company Name: ')); ?>
    <?php echo $this->Form->input('address1', array( 'label' => 'Address: ')); ?>
    <?php echo $this->Form->input('address2', array( 'label' => '')); ?>
    <?php echo $this->Form->input('city', array( 'label' => 'City: ')); ?>
    <?php echo $this->Form->input('state', array( 'label' => 'State: ')); ?>
    <?php echo $this->Form->input('zip', array( 'label' => 'Zip Code: ')); ?>
    <?php echo $this->Form->input('phone', array( 'label' => 'Phone Number: ')); ?>
    <?php echo $this->Form->input('contact_name', array( 'label' => 'Contact Name: ')); ?>
    <?php echo $this->Form->input('email', array( 'label' => 'Email: ')); ?>
    <?php echo $this->Form->end('Register'); ?>


    