<h3>Account Setup</h3>

<br/>
    <?php echo $this->Form->create('Setting', array('action' => 'setup/'.$id)); ?>
    <?php echo $this->Form->input('site_url', array( 'label' => 'Website Url: ')); ?>
    <?php echo $this->Form->input('from_email', array( 'label' => 'From Email Address: ')); ?>
    <?php echo $this->Form->input('replyto_email', array( 'label' => 'Reply To Email Address: ')); ?>
    <?php echo $this->Form->input('lead_price', array( 'label' => 'Price per Lead: ')); ?>
    <?php echo $this->Form->end('Submit'); ?>


    