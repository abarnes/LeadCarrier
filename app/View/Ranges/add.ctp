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
			<h2 style="max-width:500px;float:left;">Price Ranges - <?php echo $name; ?></h2>
			<div style="float:right;">
				<a href="/ranges/index/<?php echo $id; ?>"><input type="button" value="Manage Price Ranges" class="mws-button black mws-i-24 i-table-1 large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_<?php if (!empty($r)) { echo '5'; } else { echo '8'; } ?>">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Add Price Range</span>
                    </div>
                    <div class="mws-panel-body">
                        <div class="mws-wizard clearfix">
                            <ul>
                                <li>
                                    <a class="mws-ic-16 ic-application-edit" href="#">Provide Industry Information</a>
                                </li>
                                <li class="current">
                                    <a class="mws-ic-16 ic-money-dollar" href="#">Set Up Price Ranges</a>
                                </li>
                            </ul>
                        </div>
			<?php
				echo $this->Form->create('Range', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'add/'.$id
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
                    		</div>
    
                    		<div class="mws-button-row">
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
		</div>
		    
		    <?php if (!empty($r)) { ?>
		    <div class="mws-panel grid_3">
			<div class="mws-panel-header">
			    <span class="mws-i-24 i-price-tag">Current Price Ranges</span>
			</div>
			<div class="mws-panel-body">
			    <div class="mws-panel-content">
					    <h5>
					    <?php foreach ($r as $r) {
						echo $r['Range']['name'].'<br/>';   
					    } ?>
					    </h5>
			    </div>
			</div>
		    </div>
		    <?php } ?>
		    

		