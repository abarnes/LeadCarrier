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
			<h2 style="max-width:500px;float:left;">Change Password</h2>
			<div style="float:right;">

			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-cog-4">Change Password</span>
                    </div>
                    <div class="mws-panel-body">
                    	<?php
				echo $this->Form->create('User', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'vendor_passwordchange/'.$id
				)); ?>
                    		<div class="mws-form-inline">
					<div class="mws-form-row">
                    				<label>New Password</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('password', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Retype New Password</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('password2', array( 'class' => 'mws-textinput','type'=>'password')); ?>
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>