<?php if ($setup=='0') { ?>
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
		<?php if (isset($current_user)&&$current_user['admin']=='0') { ?>
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
<?php } else { ?>
	
<?php } ?>
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
		    <?php if ($setup=='1') { ?>
			<h2>Welcome to Lead Carrier!</h2><h5>Set up your First User</h5>
		    <?php } else { ?>
			<h2 style="max-width:500px;float:left;">Add a User</h2>
		    <?php } ?>
			<div style="float:right;">
			<?php if ($setup=='0') { ?>
			    <?php if (isset($current_user)&&$current_user['admin']=='0') { ?>
				    <a href="/settings"><input type="button" value="Admin Panel" class="mws-button black mws-i-24 i-cog-4 large"></a>
			    <?php } else { ?>
				    <a href="/admin/users"><input type="button" value="Admin Users" class="mws-button black mws-i-24 i-cog-4 large"></a>
			    <?php } ?>
			<?php } ?>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-cog-4">User Information</span>
                    </div>
                    <div class="mws-panel-body">
                    	<?php
				if (isset($current_user)) {
				    $r = 'user';
				} else {
				    $r = '';
				}
				echo $this->Form->create('User', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'add/'.$id.'/'.$r
				)); ?>
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Username</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('username', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Email</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('email', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Password</label>
                    				<div class="mws-form-item medium">
                    					<?php echo $this->Form->input('password', array( 'class' => 'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Retype Password</label>
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