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
                	<li><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
			<li class="active"><a href="/affiliates" class="mws-i-24 i-link-2">Affiliates</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Affiliates</h2>
			<div style="float:right;">
				<a href="/affiliates"><input type="button" value="Manage Affiliates" class="mws-button black mws-i-24 i-link-2 large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-link-2">Add Affiliate</span>
                    </div>
                    <div class="mws-panel-body">
			<?php
				echo $this->Form->create('Affiliate', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'add'
				)); ?>				
				
				<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Name: </label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('name', array( 'label' => '','class'=>'mws-textinput','type'=>'text')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Percentage: </label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('percentage', array( 'label' => '','class'=>'mws-textinput','type'=>'text')); ?>
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
		    

		