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
                	<li><a href="/dashboard" class="mws-i-24 i-home">Dashboard</a></li>
			<li>
				<a href="/pending" class="mws-i-24 i-plus">
					Pending <span class="mws-nav-tooltip">+<?php echo $pendings; ?></span>
				</a>
			</li>
                	<li><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
                	<li><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li class="active"><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Lead Carrier API</h2>
		</div>
		
		<!----settings---->

		<div class="mws-panel grid_5">
				<h6>To get started, download the Lead Carrier API documentation.</h6>
				<a href="/files/LeadCarrierAPI.pdf">API Documentation</a>
				<br/><br/>
				<p style="font-size:1.1em;">Download the Lead Carrier PHP API Kit for simple integration.</p>
				<a href="/files/PhpApiKit.zip">PHP API Kit</a><br/>
				<p style="font-size:1.1em;">Use the credentials on the right to authenticate your requests with our API.</p>
                </div>
		
		<div class="mws-panel grid_3">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-list">API Configuration Information</span>
                    </div>
                    <div class="mws-panel-body">
				<table class="mws-datatable-fn mws-table">
				<tbody>
						<tr>
								<td>
										API Token
								</td>
								<td>
										<?php echo $company['Company']['api_token']; ?>
								</td>
						</tr>
						<tr>
								<td>
										Company Name
								</td>
								<td>
										<?php echo $company['Company']['name']; ?>
								</td>
						</tr>
						<tr>
								<td>
										Access URL
								</td>
								<td>
										<?php echo 'http://'.$company['Company']['subdomain'].'.leadcarrier.com'; ?>
								</td>
						</tr>
				</tbody>
				</table>
                    </div>    	
                </div>

            </div>