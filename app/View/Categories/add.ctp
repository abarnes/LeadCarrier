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
            	<ul>
                	<li><a href="/dashboard" class="mws-i-24 i-home">Dashboard</a></li>
			<li>
				<a href="/pending" class="mws-i-24 i-plus">
					Pending <span class="mws-nav-tooltip">+<?php echo $pendings; ?></span>
				</a>
			</li>
                	<li><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
                	<li class="active"><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Add an Industry</h2>
			<div style="float:right;">
				
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Add Industry</span>
                    </div>
                    <div class="mws-panel-body">
                        <div class="mws-wizard clearfix">
                            <ul>
                                <li class="current">
                                    <a class="mws-ic-16 ic-application-edit" href="#">Provide Industry Information</a>
                                </li>
                                <li>
                                    <a class="mws-ic-16 ic-money-dollar" href="#">Set Up Price Ranges</a>
                                </li>
                            </ul>
                        </div>
			<?php
				echo $this->Form->create('Category', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'add'
				)); ?>	
				
				<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Name</label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('name', array( 'label' => '','class'=>'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Options</label>
                    				<div class="mws-form-item clearfix">
                    					<ul class="mws-form-list">
                    						<li><?php echo $this->Form->input('use_ranges', array( 'label' => 'Use Price Ranges')); ?></li>
                    						<li><?php echo $this->Form->input('enable', array( 'label' => 'Enable','checked'=>true)); ?></li>
                    					</ul>
                    				</div>
                    			</div>			
					
                    		</div>
    
                    		<div class="mws-button-row">
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>
		