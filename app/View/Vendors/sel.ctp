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
                	<li class="active"><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
                	<li><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Add a Vendor</h2>
			<div style="float:right;">
				<a href="/vendors/manage"><input type="button" value="All Vendors" class="mws-button black mws-i-24 i-apartment-building large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Select an Industry</span>
                    </div>
                    <div class="mws-panel-body">
                        <div class="mws-wizard clearfix">
                            <ul>
                                <li class="current">
                                    <a class="mws-ic-16 ic-buildings" href="#">Select Industry</a>
                                </li>
                                <li>
                                    <a class="mws-ic-16 ic-application-edit" href="#">Provide Vendor Information</a>
                                </li>
                            </ul>
                        </div>
			<?php
				echo $this->Form->create('Vendor', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'sel'
				)); ?><br/>
                    		<div class="mws-form-inline">

                    			<div class="mws-form-row">
                    				<label>Industry</label>
                    				<div class="mws-form-item large">
							<ul class="mws-form-list inline">
							    <?php echo $this->Form->input('Category', array( 'label' => '','multiple'=>'checkbox','div'=>false,'before'=>'<li>','after'=>'</li>')); ?>
							</u>
                    				</div>
                    			</div>
                    		</div>

                    		<div class="mws-button-row">
                    			<input type="submit" value="Next" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>
		