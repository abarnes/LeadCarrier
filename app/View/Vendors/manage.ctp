<script type="text/javascript">
	var i;
	function st(id,email) {
		$('#insert').html(email);
		$('#VendorI').val(id);
		return false;
	}
	
    $(document).ready(function() {
		$("#mws-jui-dialog").dialog({
		autoOpen: false, 
		title: "Send Email", 
		modal: true, 
		width: "640", 
		buttons: [{
			text: "Close Dialog", 
			click: function() {
			    $( this ).dialog( "close" );
			}}]
	    });
		$(".btn").bind("click", function(event) {
		$("#mws-jui-dialog").dialog("option", {modal: true}).dialog("open");
		event.preventDefault();
	    });
    });
</script>
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
		var answer = confirm('Are you sure you want to delete this vendor?  This cannot be undone.');
	} else {
		var answer = true;
	}
	if (answer) {
		$('#VendorAction').val(action);
		$('#VendorSubmitForm').submit();
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
                	<li class="active"><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
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
			<h2 style="max-width:500px;float:left;">Vendors</h2>
			<div style="float:right;">
				<a href="/vendors/sel"><input type="button" value="Add Vendor" class="mws-button blue mws-i-24 i-plus large"></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">All Vendors</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li id="edit"><a href="#" onclick="button('view');" class="mws-ic-16 ic-page-2">View</a></li>
				<li id="view"><a href="#" onclick="button('edit');" class="mws-ic-16 ic-page-white-text">Edit</a></li>
				<li><a href="#" onclick="button('active');" class="mws-ic-16 ic-connect">Make Active</a></li>
				<li><a href="#" onclick="button('inactive');" class="mws-ic-16 ic-disconnect">Make Inactive</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>
                            	<li><a href="#" class="mws-ic-16 ic-edit">Update</a></li>-->
                            </ul>
                        </div>
			<?php echo $this->Form->create('Vendor',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				    <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>Status</th>
				    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Zip</th>
				    <th>Industry</th>
				    <th>Join Date</th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($vendors as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['Vendor']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <?php switch($u['Vendor']['active']) {
						case '0':
						    echo 'Paused';
						    break;
						case '1':
						    echo 'Active';
						    break;
					    } ?>
					</td>
					<td>
					    <a href="/vendors/view/<?php echo $u['Vendor']['id']; ?>"><?php printf("%06s", $u['Vendor']['id']); ?></a>
					</td>
					<td>
					    <?php echo $u['Vendor']['name']; ?>
					</td>
					<td>
					    <input type="button" id="mws-jui-dialog-mdl-btn" class="mws-button blue btn" onclick="st('<?php echo $u['Vendor']['id']; ?>','<?php echo $u['Vendor']['email']; ?>')" value="<?php echo $u['Vendor']['email']; ?>" style="min-width:150px;">
					    <?php //echo '<a href="mailto:'.$u['Vendor']['email'].'">'.$u['Vendor']['email'].'</a>'; ?>
					</td>
					<td>
					    <?php echo $u['Vendor']['phone']; ?>
					</td>
					<td>
					    <?php echo $u['Vendor']['zip']; ?>
					</td>
					<td>
					    <?php echo $u['Category']['name']; ?>
					</td>
					<td>
					    <?php echo date('m-j-Y',strtotime($u['Vendor']['created'])); ?>
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
			</form>
                    </div>
                </div>
            </div>
	    
	    <div id="mws-jui-dialog" class="ui-dialog-content ui-widget-content" style="width: auto; min-height: 10px; height: auto; " scrolltop="0" scrollleft="0">
				            <h3>Send Email - <span id="insert"></span></h3>
					    <div class="mws-panel-body">
						
						<?php echo $this->Form->create('Vendor',array('class'=>'mws-form','action'=>'sendmail')); ?>
							<?php echo $this->Form->hidden('i',array('value'=>'none')); ?>
							<div class="mws-form-inline">
								<div class="mws-form-row">
									<label>Subject</label>
									<div class="mws-form-item medium">
										<input type="text" class="mws-textinput" id="VendorSubject" name="data[Vendor][subject]">
									</div>
								</div>
								<div class="mws-form-row">
									<label>Message</label>
									<div class="mws-form-item large">
										<textarea rows="100%" cols="100%" name="data[Vendor][message]" id="VendorMessage"></textarea>
									</div>
								</div>
								<div class="mws-form-row">
									<input type="submit" value="Send" class="mws-button green" style="float:right;">
								</div>

						</form>
					    </div>    	
					</div>
	    </div>
	   