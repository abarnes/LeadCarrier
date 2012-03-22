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
		$("#master2").click(function(){
		  var checked_status = this.checked;
                    $("input[class=ck2]").each(function()
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
		
		//Hide div w/id extra
		<?php if ($this->request->data['Setting']['use_freshbooks']=='1') { ?>
		$("#hidden").css("display","block");
		<?php } else { ?>
		$("#hidden").css("display","none");
		<?php } ?>

		// Add onclick handler to checkbox w/id checkme
	   $("#SettingUseFreshbooks").click(function(){

		// If checked
		if ($("#SettingUseFreshbooks").is(":checked"))
		{
			//show the hidden div
			$("#hidden").show("fast");
		}
		else
		{
			//otherwise, hide it
			$("#hidden").hide("fast");
		}
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
		var answer = confirm('Are you sure you want to delete these users?  This cannot be undone.');
	}
	if (answer) {
		$('#UserAction').val(action);
		$('#UserSubmitForm').submit();
	}
}

function button2(action){
	if (action=='delete') {
		var answer2 = confirm('Are you sure you want to delete these fields?  This cannot be undone and all data will be lost.');
	} else {
		var answer2 = true;
	}
	if (answer2) {
		$('#FieldAction').val(action);
		$('#FieldSubmitForm').submit();
	}
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
				<a href="/companies/api" style="float:right;"><input type="button" value="API Information" class="mws-button blue mws-i-24 i-link-2 large"></a>
			</div>	
		</div>
		
		<!----settings---->

		<div class="mws-panel grid_4">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">Account Settings</span>
                    </div>
                    <div class="mws-panel-body">
                    	
			<?php
				echo $this->Form->create('Setting', array(
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
                    				<label>"From" Email Address</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('from_email', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>"Reply To" Email Address</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('replyto_email', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>Site URL</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('site_url', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Price per Lead</label>
                    				<div class="mws-form-item">
								<div class="ui-spinner">
								<?php echo $this->Form->input('lead_price', array('class'=>'mws-textinput ui-spinner-box','type'=>'text')); ?>
								</div>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Leads per Industry</label>
                    				<div class="mws-form-item">
								<div class="ui-spinner">
                                                                    <?php echo $this->Form->input('leads_per_industry', array('class'=>'mws-textinput ui-spinner-box','type'=>'text')); ?>
								</div>
                    				</div>
                    			</div>
					<div class="mws-form-row">
                    				<label>Billing Period</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('bill_period', array('class'=>'mws-textinput','options'=>array('weekly'=>'weekly','bi-weekly'=>'bi-weekly','monthly'=>'monthly'))); ?>
                    					
                    				</div>
                    			</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Save" class="mws-button black">
                    		</div>
                    	</form>
                    </div>    	
                </div>
		
		<div class="mws-panel grid_4">
				
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">Freshbooks Settings</span>
                    </div>
                    <div class="mws-panel-body">
                    	
			<?php
				echo $this->Form->create('Setting', array(
				    'inputDefaults' => array(
					'label' => false,
					'div' => false
				    ),
				    'class'=>'mws-form',
				    'action'=>'freshbooks_edit'
				)); ?>
				
				<?php echo $this->Form->input('id', array( 'type'=>'hidden')); ?>
                    		<div class="mws-form-inline">
                    			<div class="mws-form-row">
                    				<label>Use Freshbooks</label>
                    				<div class="mws-form-item large">
						<?php echo $this->Form->input('use_freshbooks', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
					<div id="hidden">
						<div class="mws-form-row">
								<p>The URL is the link you use to access your freshbooks account, and the API token can be found under your Freshbooks account settings.</p>
							<label>Freshbooks URL</label>
							<div class="mws-form-item large">
							<?php echo $this->Form->input('freshbooks_url', array('class'=>'mws-textinput')); ?>
								
							</div>
						</div>
						<div class="mws-form-row">
							<label>Freshbooks API Token</label>
							<div class="mws-form-item large">
							<?php echo $this->Form->input('freshbooks_api_token', array('class'=>'mws-textinput')); ?>
								
							</div>
						</div>
					</div>
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Save" class="mws-button black">
                    		</div>
                    	</form>
                    </div>    	
                </div>
		
		<hr/>
		<div style="float:right;margin-bottom:20px;">
				<a href="/users/add/<?php echo $current_user['company_id']; ?>"><input type="button" value="Add User" class="mws-button blue mws-i-24 i-plus large"></a>
		</div>	
                <!-------user table---->
                
            	<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Users</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="edit"><a href="#" onclick="button('edit');" id="edit" class="mws-ic-16 ic-page-white-text">Edit</a></li>
				<li id="password"><a href="#" onclick="button('password');" id="edit" class="mws-ic-16 ic-key">Change Password</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('User',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>Username</th>
				    <th>Email</th>
				    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($users as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['User']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <?php echo $u['User']['username']; ?>
					</td>
					<td>
					    <?php echo $u['User']['email']; ?>
					</td>
					<td class="hid" style="width:300px;">
					    <a href="/users/edit/<?php echo $u['User']['id']; ?>" style="text-decoration:none;"><input type="button" value="Edit" class="mws-button green mws-i-24 small"></a>
					    <a href="/users/passwordchange/<?php echo $u['User']['id']; ?>" style="text-decoration:none;"><input type="button" value="Change Password" class="mws-button blue mws-i-24 small"></a>
					    <a href="/users/delete/<?php echo $u['User']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?')"><input type="button" value="Delete" class="mws-button red mws-i-24 small"></a>
					</td>
				</tr>
			    <?php } ?>
			    </form>
                            </tbody>
                        </table>
                    </div>
                </div>
		
		<hr/>
		<!-------fields table---->
		<p style="float:left;margin-left:20px;margin-top:16px;">Manage the data fields saved for each client and displayed in the client tables. This will alter the database, and changes are permanent.</p>
		<div style="float:right;margin-top:0px;margin-bottom:20px;">
				<a href="/fields/add"><input type="button" value="Add Field" class="mws-button blue mws-i-24 i-plus large"></a>
		</div>                
		
            	<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Fields</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button2('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
                            </ul>
                        </div>
			<?php echo $this->Form->create('Field',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master2" onclick="chk2();"/></th>
                                    <th>Display Name</th>
				    <th>Name</th>
				    <th>Type</th>
				    <th>Display in Table</th>
				    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($fields as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['Field']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck2','onclick'=>'chk2();')); ?></td>
					<td>
					    <?php echo $u['Field']['display_name']; ?>
					</td>
					<td>
					    <?php echo $u['Field']['name']; ?>
					</td>
					<td>
						<?php echo $u['Field']['type']; ?>
					</td>
					<td>
						<?php
						switch ($u['Field']['display']) {
								case '1':
										echo 'yes';
										break;
								default:
										echo 'no';
										break;
						} ?>
					</td>
					<td class="hid" style="width:300px;">
					    <a href="/fields/delete/<?php echo $u['Field']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete these fields?  This cannot be undone and all data will be lost.')"><input type="button" value="Delete" class="mws-button red mws-i-24 small"></a>
					    <a href="/fields/toggle_display/<?php echo $u['Field']['id']; ?>" style="text-decoration:none;"><input type="button" value="Toggle Display" class="mws-button blue mws-i-24 small"></a>
					</td>
				</tr>
			    <?php } ?>
			    </form>
                            </tbody>
                        </table>
                    </div>
                </div>				
		
            </div>