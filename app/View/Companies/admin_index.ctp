<script type="text/javascript">
	var i;
	function st(id,email) {
		$('#insert').html(email);
		$('#CompanyI').val(id);
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
		document.getElementById('edit').style.display='none';
		document.getElementById('view').style.display='none';
	} else {
		document.getElementById('edit').style.display='block';
		document.getElementById('view').style.display='block';
	}
	return false;
}

function button(action){
	if (action=='delete') {
		confirm('Are you sure you want to delete this company?  This cannot be undone.');
	}
	$('#CompanyAction').val(action);
	$('#CompanySubmitForm').submit();
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
                	<li class="active"><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;"><?php echo $show; ?> Companies</h2>
			<div style="float:right;">
				<a href="/admin/companies"><input type="button" value="All" class="mws-button black mws-i-24 i-multiple-users large" <?php if ($show=='All') {echo 'disabled="disabled"';} ?>/></a>
				<a href="/admin/companies/index/active"><input type="button" value="Active" class="mws-button green mws-i-24 i-check large" <?php if ($show=='Active') {echo 'disabled="disabled"';} ?>></a>
				<a href="/admin/companies/index/inactive"><input type="button" value="Inactive" class="mws-button red mws-i-24 i-acces-denied-sign large" <?php if ($show=='Inactive') {echo 'disabled="disabled"';} ?>></a>
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Companies</span>
                    </div>
                    <div class="mws-panel-body">
			<div class="mws-panel-toolbar top clearfix">
                        	<ul>
                            	<li><a href="#" onclick="button('delete');" class="mws-ic-16 ic-delete">Delete</a></li>
				<li><a href="#" id="view" onclick="button('view');" class="mws-ic-16 ic-page-2">View</a></li>
                            	<!--<li><a href="#" class="mws-ic-16 ic-arrow-refresh">Renew</a></li>-->
                            	<li><a href="#" id="edit" onclick="button('edit');" class="mws-ic-16 ic-edit">Edit</a></li>
                            </ul>
                        </div>
			<?php echo $this->Form->create('Company',array('action'=>'submit')); ?>
			<?php echo $this->Form->input('action',array('type'=>'hidden')); ?>
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
				     <th><input type="checkbox" id="master" onclick="chk();"/></th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Subdomain</th>
				    <th>Email</th>
                                    <th>Join Date</th>
                                </tr>
                            </thead>
                            <tbody>
				<?php foreach ($companies as $u) { ?>
				<tr>
					<td><?php echo $this->Form->input('check'.$u['Company']['id'],array('type'=>'checkbox','label'=>'','class'=>'ck','onclick'=>'chk();')); ?></td>
					<td>
					    <a href="/admin/companies/view/<?php echo $u['Company']['id']; ?>"><?php printf("%06s", $u['Company']['id']); ?></a>
					</td>
					<td>
					    <?php echo $u['Company']['name']; ?>
					</td>
					<td>
					    <?php echo $u['Company']['subdomain']; ?>
					</td>
					<td>
						<input type="button" id="mws-jui-dialog-mdl-btn" class="mws-button blue btn" onclick="st('<?php echo $u['Company']['id']; ?>','<?php echo $u['Company']['email']; ?>')" value="<?php echo $u['Company']['email']; ?>" style="min-width:150px;">
					</td>
					<td>
					    <?php echo date('g:ia m-j-Y',strtotime($u['Company']['created'])); ?>
					</td>
					<!--<td>
					    <?php /*echo $this->Html->link('Approve',array('action'=>'approve/'.$u['Company']['id'])); ?>
					    <?php echo $this->Html->link('View',array('action'=>'view/'.$u['Company']['id'])); ?>
					    <?php echo $this->Html->link('Edit',array('action'=>'edit/'.$u['Company']['id'])); ?>
					    <?php echo $this->Html->link(
								'Delete', 
								array('controller'=>'clients','action'=>'delete/'.$u['Company']['id']), 
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
						
						<?php echo $this->Form->create('Company',array('class'=>'mws-form','action'=>'sendmail')); ?>
							<?php echo $this->Form->hidden('i',array('value'=>'none')); ?>
							<div class="mws-form-inline">
								<div class="mws-form-row">
									<label>Subject</label>
									<div class="mws-form-item medium">
										<input type="text" class="mws-textinput" id="CompanySubject" name="data[Company][subject]">
									</div>
								</div>
								<div class="mws-form-row">
									<label>Message</label>
									<div class="mws-form-item large">
										<textarea rows="100%" cols="100%" name="data[Company][message]" id="CompanyMessage"></textarea>
									</div>
								</div>
								<div class="mws-form-row">
									<input type="submit" value="Send" class="mws-button green" style="float:right;">
								</div>

						</form>
					    </div>    	
					</div>
	    </div>
