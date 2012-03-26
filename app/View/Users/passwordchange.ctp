<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
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
            	<?php if ($current_user['admin']==0) { ?>
            	<ul>
                	<li><a href="/dashboard" class="mws-i-24 i-home">Dashboard</a></li>
			<li>
				<a href="/pending" class="mws-i-24 i-plus">
					Pending <span class="mws-nav-tooltip">+<?php echo $pendings; ?></span>
				</a>
			</li>
                	<li><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
                	<li><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li class="active"><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
		<?php } else { ?>
		<ul>
		    <li><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                    <li class="active"><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
		</ul>
		<?php } ?>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Change Password - <?php echo $name; ?></h2>
			<div style="float:right;">
				<?php if ($current_user['admin']==0) { ?>
				    <a href="/settings"><input type="button" value="Admin Panel" class="mws-button black mws-i-24 i-cog-4 large"></a>
				<?php } else { ?>
				    <a href="/admin/users"><input type="button" value="Admin Users" class="mws-button black mws-i-24 i-cog-4 large"></a>
				<?php } ?>
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
				    'action'=>'passwordchange/'.$id
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