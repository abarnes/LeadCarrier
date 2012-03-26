<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<script type="text/javascript">
$(document).ready(function(){
		$("#master").click(function(){
		  var checked_status = this.checked;
                    $("input[class=ck]").each(function()
                    {
			/*if (this.checked==false) {
				this.checked=true;
			} else {
				this.checked=false;
			}*/
                     this.checked = true;
                    });
		    chk();
		    return true;
		 });
});

function chk() {
	var $b = $('input[type=checkbox]');
	var cnt = $b.filter(':checked').length;
	if (document.getElementById('master').checked == true) {
		var max = 2;
	} else {
		var max = 1;
	}
	if (cnt>max) {
		document.getElementById('edit').style.display='none';
		document.getElementById('password').style.display='none';
	} else {
		document.getElementById('edit').style.display='block';
		document.getElementById('password').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		confirm('Are you sure you want to delete these users?  This cannot be undone.');
	}
	$('#UserAction').val(action);
	$('#UserSubmitForm').submit();
}
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
		<?php if ($admin=='0') { ?>
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
                	<li class="active"><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
                </ul>
		<?php } ?>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Company Profile</h2>
			<div style="float:right;">
			<?php if ($admin=='1') { ?>
				<a href="/admin/companies"><input type="button" value="Manage Companies" class="mws-button black mws-i-24 i-apartment-building large"></a>
				<a href="/admin/companies/delete/<?php echo $c['Company']['id']; ?>" onclick="return confirm('Are you sure you want to delete this company?  This cannot be undone.')"><input type="button" value="Delete" class="mws-button red mws-i-24 i-cross large"></a>
		        <?php } ?>
			</div>	
		</div>
		
		<!----settings---->

		<div class="mws-panel grid_5">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">Edit Company Profile</span>
                    </div>
                    <div class="mws-panel-body">
                    	
			<?php
				echo $this->Form->create('Company', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'edit/'.$id
				)); ?>		
				
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    		<div class="mws-form-inline">
				        <?php if ($admin=='1') { ?>
					<div class="mws-form-row">
                    				<label>Name</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('name', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<?php } ?>
                    			<div class="mws-form-row">
                    				<label>Address</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('address1', array('class'=>'mws-textinput')); ?>
						<?php echo $this->Form->input('address2', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>City</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('city', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>State</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('state', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Zip</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('zip', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Phone</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('phone', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Email</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('email', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Contact Name</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('contact_name', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Subdomain</label>
                    				<div class="mws-form-item small">
						<?php echo $this->Form->input('subdomain', array('class'=>'mws-textinput')); ?>.leadcarrier.com
                    					
                    				</div>
                    			</div>
					<?php if ($admin=='1') { ?>
					<div class="mws-form-row">
                    				<label>Active</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('active', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Free</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('free', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Plan</label>
                    				<div class="mws-form-item medium">
						<?php echo $this->Form->input('plan', array('class'=>'mws-textinput','options'=>array('monthly'=>'monthly','quarterly'=>'quarterly','annual'=>'annual'))); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Notes</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('notes', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<?php } ?>
					
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Save" class="mws-button black">
                    		</div>
                    	</form>
                    </div>    	
                </div>
		
		<div class="mws-panel grid_3">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">API Configuration Information</span>
                    </div>
                    <div class="mws-panel-body">
				<table class="mws-datatable-fn mws-table">
				<tbody>
						<tr>
								<td>
										API Token
								</td>
								<td>
										<?php echo $this->request->data['Company']['api_token']; ?>
								</td>
						</tr>
						<tr>
								<td>
										Company Name
								</td>
								<td>
										<?php echo $this->request->data['Company']['name']; ?>
								</td>
						</tr>
						<tr>
								<td>
										Access URL
								</td>
								<td>
										<?php echo 'http://'.$this->request->data['Company']['subdomain'].'.leadcarrier.com'; ?>
								</td>
						</tr>
				</tbody>
				</table>
                    </div>
		    <br/>
		    <a href="/companies/api" style="float:right;"><input type="button" value="API Information" class="mws-button blue mws-i-24 i-link-2 large"></a>
                </div>

            </div>