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
		document.getElementById('view').style.display='none';
		//document.getElementById('edit').style.display='none';
	} else {
		document.getElementById('view').style.display='block';
		//document.getElementById('edit').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		var answer = confirm('Are you sure you want to delete these?  This cannot be undone.');
	} else {
		var answer = true;
	}
	if (answer) {
		$('#ClientAction').val(action);
		$('#ClientSubmitForm').submit();
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
			<li class="active">
				<a href="/pending" class="mws-i-24 i-plus">
					Pending <span class="mws-nav-tooltip">+<?php echo $pendings; ?></span>
				</a>
			</li>
                	<li><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
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
			<h2 style="max-width:500px;float:left;">Pending Review</h2>
			<div style="float:right;">
				
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Pending Review</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button('approve');" class="mws-ic-16 ic-accept">Approve</a></li>
                            	<li><a href="#" onclick="button('reject');" class="mws-ic-16 ic-cross">Reject</a></li>
				<li><a href="#" id="view" onclick="button('view');" class="mws-ic-16 ic-page-2">View</a></li>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('Client',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
			<?php echo $this->Form->input('url',array('type'=>'hidden','value'=>'pending')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>ID</th>
                                    <th>Time Submitted</th>
                                    <?php foreach ($fields as $f) {
					echo '<th>'.$f['Field']['display_name'].'</th>';
				    } ?>
				    <th></th>
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
					<?php foreach ($fields as $f) { ?>
						<td>
							<?php
								switch ($f['Field']['type']) {
									case 'date':
										echo date('m-j-Y',strtotime($u['Client'][$f['Field']['name']]));
										break;
									case 'datetime':
										echo date('g:ia m-j-Y',strtotime($u['Client'][$f['Field']['name']]));
										break;
									case 'tinyint':
										if (isset($u['Client'][$f['Field']['name']])&&$u['Client'][$f['Field']['name']]=='1') {
											echo 'yes';
										} else {
											echo 'no';
										}
										break;
									default:
										if ($f['Field']['name']!='email') {
											echo $u['Client'][$f['Field']['name']];	
										} else {
											echo '<a href="mailto:'.$u['Client'][$f['Field']['name']].'">'.$u['Client'][$f['Field']['name']].'</a>';	
										}
										break;
								}
							
							?>
						</td>
					<?php } ?>
					<td>
						<a href="/clients/approve/<?php echo $u['Client']['id']; ?>"><input type="button" value="Approve" class="mws-button green mws-i-24 small"></a>
						<a href="/clients/reject/<?php echo $u['Client']['id']; ?>"><input type="button" value="Reject" class="mws-button red mws-i-24 small"></a>
					</td>
				</tr>
				<?php } ?>
                            </tbody>
                        </table>
			</form>
                    </div>
                </div>
            </div>
