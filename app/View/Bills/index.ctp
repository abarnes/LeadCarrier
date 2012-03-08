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
                	<li><a href="/records/vendor_view" class="mws-i-24 i-group-2">Leads</a></li>
                	<li class="active"><a href="/bills" class="mws-i-24 i-archive">Bills</a></li>
                	<li><a href="/vendors/vendor_edit" class="mws-i-24 i-cog-4">Profile</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Bills</h2>
			<div style="float:right;">
				
			</div>	
		</div>

                
            	<div class="mws-panel grid_8">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-price-tag">Billing History </span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-datatable-fn mws-table">
			<thead>
				<tr>
				    <th>
				       Paid [yes/no]
				    </th>
				    <th>
					Week
				    </th>
				    <th>
					# of Leads
				    </th>
				    <th>
					Balance
				    </th>
				    <th class="hid" style="width:120px;">
					
				    </th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($bills as $h) { ?>
				<tr>
				    <td>
					<?php
					    if ($h['Bill']['paid']=='1') {
						echo 'yes';
					    } else {
						echo 'no';
					    }
					?>
				    </td>
				    <td>
					<?php echo $h['Bill']['week_start'].' - '.$h['Bill']['week_end']; ?>
				    </td>
				    <td>
					<?php echo $h['Bill']['leads']; ?>
				    </td>
				    <td>
					$<?php echo $h['Bill']['total']; ?>
				    </td>
				    <td class="hid">
					<?php if ($h['Bill']['freshbooks_invoice_id']!='') { ?>
					    <a href="/bills/view_freshbooks_bill/<?php echo $h['Bill']['freshbooks_invoice_id']; ?>" target="_blank" style="text-decoration:none;"><input type="button" value="Freshbooks" class="mws-button green mws-i-24 small"></a>	
					<?php } else { ?>
					    <a href="/bill/view/<?php echo $h['Bill']['id']; ?>" target="_blank" style="text-decoration:none;"><input type="button" value="View Bill" class="mws-button green mws-i-24 small"></a>							
					<?php } ?>
				    </td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
		    </div>
		</div>