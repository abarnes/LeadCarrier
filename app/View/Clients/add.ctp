<h4>Sign Up (temporary page)</h4>
<div style="width:60%;">
    
    <div class="label">
    <?php echo $this->Form->create('Client', array('action' => 'add')); ?>
    <?php foreach ($fields as $f) { ?>
        <?php echo $this->Form->input($f['Field']['name'], array( 'label' => $f['Field']['display_name'])); ?>
    <?php } ?>
    <?php echo $this->Form->end('Submit'); ?>
    </div>

</div>
    