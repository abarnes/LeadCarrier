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
                	<li><a href="/dashboard" class="mws-i-24 i-home">Dashboard</a></li>d
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
			<h2 style="max-width:500px;float:left;">Price Ranges - <?php echo $range['Category']['name']; ?></h2>
			<div style="float:right;">
				<a href="/ranges/index/<?php echo $range['Category']['id']; ?>"><input type="button" value="Manage Price Ranges" class="mws-button black mws-i-24 i-table-1 large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Edit Price Range</span>
                    </div>
                    <div class="mws-panel-body">
			<?php
				echo $this->Form->create('Range', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'edit/'.$range['Range']['id']
				)); ?>	
				
				<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Low end: </label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('low_end', array( 'label' => '','class'=>'mws-textinput','type'=>'text')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>High end: </label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('high_end', array( 'label' => '','class'=>'mws-textinput','type'=>'text')); ?>
                    				</div>
                    			</div>			
					<div class="mws-form-row">
						<label>Vendors</label>
						    <div class="mws-form-item medium">
							<ul class="mws-form-list inline">
							    <?php echo $this->Form->input('Vendor', array( 'label' => '','multiple'=>'checkbox','div'=>false,'before'=>'<li>','after'=>'</li>')); ?>
							</u>
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
		