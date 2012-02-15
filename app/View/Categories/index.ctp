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
		document.getElementById('ranges').style.display='none';
		document.getElementById('edit').style.display='none';
	} else {
		document.getElementById('ranges').style.display='block';
		document.getElementById('edit').style.display='block';
	}
	return false;
}

function button(action){
	//alert(action);
	if (action=='delete') {
		confirm('Are you sure you want to delete this?  All vendors in this industry will be deleted as well.');
	}
	$('#CategoryAction').val(action);
	$('#CategorySubmitForm').submit();
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
			<h2 style="max-width:500px;float:left;">Industries</h2>
			<div style="float:right;">
				<a href="/categories/add"><input type="button" value="Add Industry" class="mws-button blue mws-i-24 i-plus large"></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">All Industries</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="edit"><a href="#" onclick="button('edit');" class="mws-ic-16 ic-page-white-text">Edit</a></li>
				<li id="ranges"><a href="#" onclick="button('ranges');" class="mws-ic-16 ic-application-view-list">Manage Ranges</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('Category',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>Name</th>
				    <th>Enabled</th>
                                    <th>Use Ranges?</th>
                                    <th>Price Ranges</th>
				    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($cats as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['Category']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <?php echo $u['Category']['name']; ?>
					</td>
					<td>
					    <?php switch($u['Category']['enable']) {
						case '0':
						    echo '[No]';
						    break;
						case '1':
						    echo '[Yes]';
						    break;
					    } ?>
					</td>
					<td>
					    <?php switch($u['Category']['use_ranges']) {
						case '0':
						    echo '[No]';
						    break;
						case '1':
						    echo '[Yes]';
						    break;
					    } ?>
					</td>
					<td>
					    <?php foreach ($u['Range'] as $r) {
						echo $r['name'].'<br/>';
					    } ?>
					</td>
					
					<td class="hid">
					    <a href="/categories/edit/<?php echo $u['Category']['id']; ?>" style="text-decoration:none;"><input type="button" value="Edit" class="mws-button green mws-i-24 small">
					    </a>
					    <a href="/categories/delete/<?php echo $u['Category']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this?  All vendors in this industry will be deleted as well.')">
						<input type="button" value="Delete" class="mws-button red mws-i-24 small">
					    </a>
					    <?php if ($u['Category']['use_ranges']=='1') { ?>
					    <a href="/ranges/index/<?php echo $u['Category']['id']; ?>" style="text-decoration:none;">
						<input type="button" value="Manage Ranges" class="mws-button black mws-i-24 small">
					    </a>
					    <?php } ?>
					    
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