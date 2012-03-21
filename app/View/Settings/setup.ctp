<script type="text/javascript">
$(document).ready(function(){
    $("#hidden").css("display","none");

    // Add onclick handler to checkbox w/id checkme
	   $("#SettingUseFreshbooks").click(function(){

		// If checked
		if ($("#SettingUseFreshbooks").is(":checked"))
		{
			//show the hidden div
			$("#hidden").show("fast");
		}
		else
		{
			//otherwise, hide it
			$("#hidden").hide("fast");
		}
	  });
});
</script>

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
                                        <div class="mws-form-row">
                    				<label>Billing Period</label>
                    				<div class="mws-form-item small">
						<?php echo $this->Form->input('bill_period', array('class'=>'mws-textinput','options'=>array('weekly'=>'weekly','bi-weekly'=>'bi-weekly','monthly'=>'monthly'))); ?>
                    				</div>
                    			</div>
                                        <!-------freshbooks stuff----->
                                        <hr/>
                                        <p style="margin-left:20px;font-size:1.1em;">Lead Carrier can integrate with <a href="http://www.freshbooks.com" target="_new">Freshbooks.com</a> to simplify your billing.</p>
                                        <div class="mws-form-row">
                    				<label>Use Freshbooks</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('use_freshbooks', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
                                        <div id="hidden">
						<div class="mws-form-row">
							<p>The URL is the link you use to access your freshbooks account, and the API token can be found under your Freshbooks account settings.</p>
							<label>Freshbooks URL</label>
							<div class="mws-form-item medium">
							<?php echo $this->Form->input('freshbooks_url', array('class'=>'mws-textinput')); ?>
								
							</div>
						</div>
						<div class="mws-form-row">
							<label>Freshbooks API Token</label>
							<div class="mws-form-item medium">
							<?php echo $this->Form->input('freshbooks_api_token', array('class'=>'mws-textinput')); ?>
								
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


    