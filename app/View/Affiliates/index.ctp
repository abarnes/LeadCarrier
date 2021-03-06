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
	} else {
		document.getElementById('edit').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		var answer = confirm('Are you sure you want to delete these affiliates?  This cannot be undone.');
	} else {
		var answer = true;
	}
	if (answer) {
		$('#AffiliateAction').val(action);
		$('#AffiliateSubmitForm').submit();
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
                	<li><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
			<li class="active"><a href="/affiliates" class="mws-i-24 i-link-2">Affiliates</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Manage Affiliates</h2>
			<div style="float:right;">
				<a href="/affiliates/add"><input type="button" value="Add Affiliate" class="mws-button blue mws-i-24 i-plus large"></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Affiliates</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
				<li id="delete"><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="edit"><a href="#" onclick="button('edit');" class="mws-ic-16 ic-page-white-text">Edit</a></li>
                            </ul>
                        </div>
			<?php echo $this->Form->create('Affiliate',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>Name</th>
				    <th>Percentage</th>
				    <th>Link</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($affiliates as $u) { ?>
				<tr>
				        <td><?php echo $this->Form->input('check'.$u['Affiliate']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <a href="/affiliates/view/<?php echo $u['Affiliate']['id']; ?>"><?php echo $u['Affiliate']['name']; ?></a>
					</td>
					<td>
					    <?php echo $u['Affiliate']['percentage']; ?>%
					</td>
					<td>
						http://leadcarrier.com/a/<?php echo $u['Affiliate']['link']; ?>
					</td>
					<td>
				             <a href="/affiliates/edit/<?php echo $u['Affiliate']['id']; ?>" style="text-decoration:none;"><input type="button" onClick="location.href = '/affiliates/edit/<?php echo $u['Affiliate']['id']; ?>'" value="Edit" class="mws-button green mws-i-24 small">
					    </a>
					    <a href="/affiliates/delete/<?php echo $u['Affiliate']['id']; ?>" style="text-decoration:none;" onclick="return confirm('Are you sure you want to delete this affiliate?')">
						<input type="button" onClick="location.href = '/affiliates/delete/<?php echo $u['Affiliate']['id']; ?>'" value="Delete" class="mws-button red mws-i-24 small">
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