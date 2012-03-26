<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<h3>Change Settings</h3>
        
        <div class="link">
        <?php //echo $this->Html->link('<< Manage Categories',array('controller'=>'categories','action'=>'index')); ?>
        </div><br/>
        
<div style="width:60%;">
    
    <div class="label">
    <?php echo $this->Form->create('Setting', array('action' => 'edit')); ?>
    <?php echo $this->Form->input('from_email', array( 'label' => 'From email address')); ?>
    <?php echo $this->Form->input('replyto_email', array( 'label' => 'Reply To email address')); ?>
    <?php echo $this->Form->input('site_url', array( 'label' => 'Site URL')); ?>
    <?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
    <?php echo $this->Form->end('Save Changes'); ?>
    </div>

</div>
    