	<div id="mws-sidebar">
        	<!--<div id="mws-searchbox" class="mws-inset">
            	<form action="table.html">
                	<input type="text" class="mws-search-input" />
                    <input type="submit" class="mws-search-submit" />
                </form>
		</div>-->
		<br/>		
		
            <!-- Main Navigation -->
            <div id="mws-navigation">
            	<ul>
                	<li><a href="/records/vendor_view" class="mws-i-24 i-group-2">Leads</a></li>
                	<li><a href="/bills" class="mws-i-24 i-archive">Bills</a></li>
                	<li class="active"><a href="/vendors/vendor_edit" class="mws-i-24 i-cog-4">Profile</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Profile</h2>
			<div style="float:right;">

			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-cog-4">Update Profile</span>
                    </div>
                    <div class="mws-panel-body">
                    	<?php
				echo $this->Form->create('Vendor', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'vendor_edit/'.$id
				)); ?>
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Name</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('name', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Email</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('email', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Phone</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('phone', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Address Line 1</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('address1', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Address Line 2</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('address2', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>City</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('city', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>State</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('state', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Zip</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('zip', array( 'class' => 'mws-textinput','type'=>'text')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Contact Name</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('contact_name', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Maximum Leads per Week</label>
                    				<div class="mws-form-item medium">
							<?php switch ($this->request->data['Vendor']['leads_per_week']) {
								case '99999':
									echo $this->Form->input('leads_per_week', array( 'class' => 'mws-textinput','type'=>'text','value'=>''));
									break;
								default:
									echo $this->Form->input('leads_per_week', array( 'class' => 'mws-textinput','type'=>'text'));
									break;
							    }?>
                    					<?php //echo $this->Form->input('leads_per_week', array( 'class' => 'mws-textinput','type'=>'text')); ?>
                    				</div>
                    			</div>
					
					<?php if (!empty($ranges)) { ?>
						<div class="mws-form-row">
							<label>Price Ranges</label>
								<div class="mws-form-item medium">
									<ul class="mws-form-list inline">
									<?php echo $this->Form->input('Range', array( 'label' => '','multiple'=>'checkbox','div'=>false,'before'=>'<li>','after'=>'</li>')); ?>
									</u>
								</div>
						</div>
					<?php } ?>
                    		</div>
                    		<div class="mws-button-row">
                    			<!--<input type="submit" value="Prev" class="mws-button gray left">-->
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>
		