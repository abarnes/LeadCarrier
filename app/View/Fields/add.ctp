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
                	<li><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li class="active"><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Add a Database Field</h2>
			<div style="float:right;">
				<a href="/settings"><input type="button" value="Admin Panel" class="mws-button black mws-i-24 i-cog-4 large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-cog-4">Add Field</span>
                    </div>
                    <div class="mws-panel-body">
			<?php
				echo $this->Form->create('Field', array(
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
                    				<label>Display Name</label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('display_name', array( 'label' => '','class'=>'mws-textinput')); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Type</label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('type', array( 'label' => '','class'=>'mws-textinput','options'=>array('varchar'=>'varchar (strings of text up to 255 characters)','text'=>'text (long blocks of text)','int'=>'int (numbers without decimals, 11 characters)','date'=>'date (MySQL date type)','datetime'=>'datetime (MySQL datetime type)','tinyint'=>'tinyint (Contains a 0 or 1, representing true or false)','decimal'=>'decimal (holds a number with a decimal, up to 4 decimal places.'))); ?>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Display in Table</label>
                    				<div class="mws-form-item large">
							<?php echo $this->Form->input('display', array( 'label' => '','class'=>'mws-textinput')); ?>
                    				</div>
                    			</div>
                    		</div>
    
                    		<div class="mws-button-row">
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
				<p>This will alter your database and cannot be edited after saving.  You can delete a field later, but all data in this field will be lost.  You may need to alter the forms on your website after modifying fields.</p>
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>
		