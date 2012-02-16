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
			<h2 style="max-width:500px;float:left;">Admin Panel</h2>
			<div style="float:right;">

			</div>	
		</div>
		
		<!----settings---->

		<div class="mws-panel grid_6">
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
				    'action'=>'edit'
				)); ?>		
				
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    		<div class="mws-form-inline">
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
					
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Save" class="mws-button black">
                    		</div>
                    	</form>
                    </div>    	
                </div>

            </div>