<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<?php //die(print_r($categories)); ?>
<script type="text/javascript">
$(document).ready(function() {
	<?php foreach ($categories as $key=>$value) { ?>
		$('#CategoryCategory<?php echo $key; ?>').click(function() {
			$('.theform').submit();
		});
	<?php } ?>
});
</script>

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
			<h2 style="max-width:500px;float:left;"><?php echo $name; ?></h2>
			<div style="float:right;">
				<a href="/vendors/manage"><input type="button" value="All Vendors" class="mws-button black mws-i-24 i-apartment-building large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-apartment-building">Update Vendor Information</span>
                    </div>
                    <div class="mws-panel-body">
                    	<?php
				echo $this->Form->create('Vendor', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form theform',
				    'action'=>'edit/'.$id
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
                    				<label>Notes</label>
                    				<div class="mws-form-item large">
                    					<?php echo $this->Form->input('notes', array( 'class' => 'mws-textinput')); ?>
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
					<div class="mws-form-inline">
						<div class="mws-form-row">
							<label>Industry</label>
							<div class="mws-form-item large">
								<ul class="mws-form-list inline">
								    <?php echo $this->Form->input('Category', array( 'label' => '','multiple'=>'checkbox','div'=>false,'before'=>'<li id="theopts">','after'=>'</li>')); ?>
								</ul>
							</div>
						</div>
					</div>
					

			
					<?php
					//build array of pre-selected ranges
					$in = array();
					foreach ($this->data['Range'] as $c) {
					    $in[$c['category_id']][$c['id']] = $c['id'];
					} ?>
					
					<?php foreach ($this->data['Category'] as $cat) {
					    if ($cat['use_ranges']=='1') {
					    ?>
					    <div class="mws-form-row">
							<label><?php echo $cat['name']; ?> <br/>Price Ranges</label>
								<div class="mws-form-item medium">
									<ul class="mws-form-list inline"><li>
									    <?php foreach ($opts[$cat['id']] as $key=>$value) {?>
										<div class="checkbox">
										    <?php if (!empty($in[$cat['id']])&&in_array($key,$in[$cat['id']])) { ?>
											<input type="checkbox" checked=true name="data[Vendor][c_<?php echo $cat['id']; ?>][]" value="<?php echo $key; ?>" id="VendorC<?php echo $cat['id'].$key; ?>">
										    <?php } else { ?>
											<input type="checkbox" name="data[Vendor][c_<?php echo $cat['id']; ?>][]" value="<?php echo $key; ?>" id="VendorC<?php echo $cat['id'].$key; ?>">
										    <?php } ?>
										    <label for="VendorC<?php echo $cat['id'].$key; ?>"><?php echo $value; ?></label>
										</div>
									    <?php } ?>
									</li></ul>
								</div>
					    </div>
					    <?php } ?>
					<?php } ?>    
					
                    		</div>
                    		<div class="mws-button-row">
                    			<!--<input type="submit" value="Prev" class="mws-button gray left">-->
                    			<input type="submit" value="Submit" class="mws-button green">
                    		</div>
                    	</form>
                    </div>
                </div>
		