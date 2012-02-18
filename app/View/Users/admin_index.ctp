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
                	<li><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li class="active"><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
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
				<a href="/users/add/<?php echo $current_user['company_id']; ?>"><input type="button" value="Add User" class="mws-button blue mws-i-24 i-plus large"></a>
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