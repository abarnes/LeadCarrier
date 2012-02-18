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
	} else {
		document.getElementById('edit').style.display='block';
	}
	return false;
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
                	<li class="active"><a href="/users" class="mws-i-24 i-cog-4">Admin</a></li>
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

		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">Inline Form</span>
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
                    				<div class="mws-form-item small">
						<?php echo $this->Form->input('from_email', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>"Reply To" Email Address</label>
                    				<div class="mws-form-item small">
						<?php echo $this->Form->input('replyto_email', array('class'=>'mws-textinput')); ?>
                    					
                    				</div>
                    			</div>
				        <div class="mws-form-row">
                    				<label>Site URL</label>
                    				<div class="mws-form-item small">
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
					
                    		</div>
                    		<div class="mws-button-row">
                    			<input type="submit" value="Submit" class="mws-button green">
                    			<input type="submit" value="Submit" class="mws-button red">
                    			<input type="submit" value="Submit" class="mws-button blue">
                    			<input type="submit" value="Submit" class="mws-button orange">
                    			<input type="submit" value="Submit" class="mws-button gray">
                    			<input type="submit" value="Submit" class="mws-button black">
                    			<input type="submit" value="Disabled" class="mws-button gray" disabled="disabled">
                    		</div>
                    	</form>
                    </div>    	
                </div>

                <!-------user table---->
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Users</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="edit"><a href="#" class="mws-ic-16 ic-page-white-text">Edit</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('User',array('action'=>'submit')); ?>
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
					<td><?php echo $this->Form->input('check',array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <?php echo $u['User']['username']; ?>
					</td>
					<td>
					    <?php echo $u['User']['email']; ?>
					</td>
					<td class="hid" style="width:300px;">
					    <a href="/users/edit/<?php echo $u['User']['id']; ?>" style="text-decoration:none;">Edit</a>
					    <a href="/users/passwordchange/<?php echo $u['User']['id']; ?>" style="text-decoration:none;">Change Password</a>
					    <a href="/users/delete/<?php echo $u['User']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?')">Remove</a>
					    
					    <?php //echo $this->Html->link('Edit',array('action'=>'edit/'.$u['Category']['id'])); ?>
					    <?php /*echo $this->Html->link(
								'Delete', 
								array('controller'=>'clients','action'=>'delete/'.$u['Category']['id']), 
								null, 
								'Are You Sure You Want To Delete This Category?'
							);*/ ?>
					</td>
				</tr>
			    <?php } ?>
			    </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>