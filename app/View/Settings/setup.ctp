<div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2>Welcome to Lead Carrier!</h2><h5>Basic Settings</h5>
			<div style="float:right;">

			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-cog-4">User Information</span>
                    </div>
                    <div class="mws-panel-body">
                    	<?php
				echo $this->Form->create('Setting', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'setup/'.$id
				)); ?>
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Website URL</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('site_url', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>"From" Email Address</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('from_email', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>"Reply To" Email Address</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('replyto_email', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Price per Lead</label>
                    				<div class="mws-form-item">
								<div class="ui-spinner">
                                                                <?php if (isset($errors)) { ?>
                                                                    <?php echo $this->Form->input('lead_price', array('class'=>'mws-textinput ui-spinner-box','type'=>'text')); ?>
                                                                <?php } else { ?>
                                                                    <?php echo $this->Form->input('lead_price', array('class'=>'mws-textinput ui-spinner-box','type'=>'text','value'=>'5.00')); ?>
                                                                <?php } ?>
								</div>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Leads per Industry</label>
                    				<div class="mws-form-item">
								<div class="ui-spinner">
                                                                <?php if (isset($errors)) { ?>
                                                                    <?php echo $this->Form->input('leads_per_industry', array('class'=>'mws-textinput ui-spinner-box','type'=>'text')); ?>
                                                                <?php } else { ?>
                                                                    <?php echo $this->Form->input('leads_per_industry', array('class'=>'mws-textinput ui-spinner-box','type'=>'text','value'=>'3')); ?>
                                                                <?php } ?>
								</div>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>


    