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
		document.getElementById('edit').style.display='none';
	} else {
		document.getElementById('view').style.display='block';
		document.getElementById('edit').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		var answer = confirm('Are you sure you want to delete these price ranges?  This cannot be undone.');
	} else {
		var answer = true;
	}
	if (answer) {
		$('#RangeAction').val(action);
		$('#RangeSubmitForm').submit();
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
			<h2 style="max-width:500px;float:left;">Manage Price Ranges - <?php echo $r['Category']['name']; ?></h2>
			<div style="float:right;">
				<a href="/categories"><input type="button" value="Manage Industries" class="mws-button black mws-i-24 i-table-1 large"></a>
				<a href="/ranges/add/<?php echo $r['Category']['id']; ?>"><input type="button" value="Add Price Range" class="mws-button blue mws-i-24 i-plus large"></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Current Price Ranges</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
				<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="view"><a href="#" onclick="button('edit');" class="mws-ic-16 ic-page-white-text">Edit</a></li>
                            </ul>
                        </div>
			<?php echo $this->Form->create('Range',array('action'=>'submit/'.$id)); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>Low End</th>
				    <th>High End</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($ranges as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check',array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    $<?php echo $u['Range']['low_end']; ?>
					</td>
					<td>
					    $<?php echo $u['Range']['high_end']; ?>
					</td>
					
					<td>
				             <a href="/ranges/edit/<?php echo $u['Range']['id']; ?>" style="text-decoration:none;"><input type="button" onClick="location.href = '/ranges/edit/<?php echo $u['Range']['id']; ?>'" value="Edit" class="mws-button green mws-i-24 small">
					    </a>
					    <a href="/ranges/delete/<?php echo $u['Range']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this price range?')">
						<input type="button" onClick="location.href = '/ranges/delete/<?php echo $u['Range']['id']; ?>'" value="Delete" class="mws-button red mws-i-24 small">
					    </a>
					    
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