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
                	<li class="active"><a href="/records/vendor_view" class="mws-i-24 i-group-2">Leads</a></li>
                	<li><a href="/bills" class="mws-i-24 i-archive">Bills</a></li>
                	<li><a href="/vendors/vendor_edit" class="mws-i-24 i-cog-4">Profile</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Leads</h2>
			<div style="float:right;">
				
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Leads</span>
                    </div>
                    <div class="mws-panel-body">
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <th>Submitted</th>
				    <?php foreach ($fields as $f) {
					echo '<th>'.$f['Field']['display_name'].'</th>';
				    } ?>
				    <th></th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($leads as $u) { ?>
				<tr>
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
						<a href="/clients/vendor_view/<?php echo $u['Client']['id']; ?>" style="text-decoration:none;"><input type="button" value="View" class="mws-button blue mws-i-24 small"></a>
					</td>
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
	   