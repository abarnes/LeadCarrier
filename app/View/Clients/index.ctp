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
		//document.getElementById('toggle').style.display='none';
		document.getElementById('view').style.display='none';
	} else {
		//document.getElementById('toggle').style.display='block';
		document.getElementById('view').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		confirm('Are you sure you want to delete these?  This cannot be undone.');
	}
	$('#ClientAction').val(action);
	$('#ClientSubmitForm').submit();
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
                	<li class="active"><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
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
			<h2 style="max-width:500px;float:left;"><?php echo $show; ?> Clients</h2>
			<div style="float:right;">
				<a href="/clients"><input type="button" value="All" class="mws-button black mws-i-24 i-multiple-users large" <?php if ($show=='All') {echo 'disabled="disabled"';} ?>/></a>
				<a href="/clients/index/approved"><input type="button" value="Approved" class="mws-button green mws-i-24 i-check large" <?php if ($show=='Approved') {echo 'disabled="disabled"';} ?>></a>
				<a href="/clients/index/rejected"><input type="button" value="Rejected" class="mws-button red mws-i-24 i-acces-denied-sign large" <?php if ($show=='Rejected') {echo 'disabled="disabled"';} ?>></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">All Clients</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" id="view" onclick="button('view');" class="mws-ic-16 ic-page-2">View</a></li>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('Client',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('url',array('type'=>'hidden','value'=>'clients')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				     <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>ID</th>
                                    <th>Time Submitted</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
				    <th>Phone</th>
				    <th>Zip Code</th>
                                </tr>
                            </thead>
                            <tbody>
				<?php foreach ($clients as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['Client']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <a href="/clients/view/<?php echo $u['Client']['id']; ?>"><?php printf("%06s", $u['Client']['id']); ?></a>
					</td>
					<td>
					    <?php echo date('g:ia m-j-Y',strtotime($u['Client']['created'])); ?>
					</td>
					<td>
					    <?php echo $u['Client']['first_name']; ?>
					</td>
					<td>
					    <?php echo $u['Client']['last_name']; ?>
					</td>
					<td>
					    <?php echo '<a href="mailto:'.$u['Client']['email'].'">'.$u['Client']['email'].'</a>'; ?>
					</td>
					<td>
					    <?php echo $u['Client']['phone']; ?>
					</td>
					<td>
					    <?php echo $u['Client']['zip']; ?>
					</td>
					<!--<td>
					    <?php /*echo $this->Html->link('Approve',array('action'=>'approve/'.$u['Client']['id'])); ?>
					    <?php echo $this->Html->link('View',array('action'=>'view/'.$u['Client']['id'])); ?>
					    <?php echo $this->Html->link('Edit',array('action'=>'edit/'.$u['Client']['id'])); ?>
					    <?php echo $this->Html->link(
								'Delete', 
								array('controller'=>'clients','action'=>'delete/'.$u['Client']['id']), 
								null, 
								'Are You Sure You Want To Delete This Person?'
							);*/ ?>
					</td>-->
				</tr>
				<?php } ?>
                            </tbody>
                        </table>
			</form?
                    </div>
                </div>
            </div>
