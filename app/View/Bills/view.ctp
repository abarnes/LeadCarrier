<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
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
		<?php if ($vendor=='1') { ?>
                	<li><a href="/records/vendor_view" class="mws-i-24 i-group-2">Leads</a></li>
                	<li class="active"><a href="/bills" class="mws-i-24 i-archive">Bills</a></li>
                	<li><a href="/vendors/vendor_edit" class="mws-i-24 i-cog-4">Profile</a></li>
		<?php } else { ?>
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
		<?php } ?>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Bill <?php echo $bill['Bill']['week_start'].' - '.$bill['Bill']['week_end']; ?></h2>
			<div style="float:right;">
				<?php if ($vendor=='1') { ?>
					<a href="/bills"><input type="button" value="All Bills" class="mws-button black mws-i-24 i-archive large"></a>
				<?php } else { ?>
					<a href="/vendor/view/<?php echo $bill['Bill']['vendor_id']; ?>/billing"><input type="button" value="Back to Vendor" class="mws-button black mws-i-24 i-aparment-building large"></a>
				<?php } ?>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-single-user">Details</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <tr>
					<td>Time Period</td>
					<td> <?php echo $bill['Bill']['week_start'].' - '.$bill['Bill']['week_end']; ?></td>
				</tr>
				<tr>
					<td>Amount</td>
					<td>$<?php echo $bill['Bill']['total']; ?></td>
				</tr>
				<tr>
					<td>Leads</td>
					<td><?php echo $bill['Bill']['leads']; ?></td>
				</tr>
				<tr>
					<td>Paid</td>
					<td>
						<?php if ($bill['Bill']['paid']=='1') {
							echo 'yes';
						} else {
							echo 'no';
						} ?>
					</td>
				</tr>
				<?php /*if ($bill['Bill']['freshbooks_invoice_id']!='') { ?>
				<!--<tr>
					<td></td>
					<td><a href="/bills/view_freshbooks_bill/<?php echo $bill['Bill']['freshbooks_invoice_id']; ?>" target="_blank" style="text-decoration:none;"><input type="button" value="Freshbooks" class="mws-button green mws-i-24 small"></a></td>
				</tr>-->
				<?php } */?>
                            </tbody>
                        </table>
		    </div>
                </div>
                
            	<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">All Leads</span>
                    </div>
                    <div class="mws-panel-body">
                        <table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <?php foreach ($fields as $f) {
					echo '<th>'.$f['Field']['display_name'].'</th>';
				    } ?>
				    <th></th>
                                </tr>
                            </thead>
                            <tbody>
			    <?php foreach ($bill['Client'] as $u) { ?>
				<tr>
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
					<td><a href="/clients/vendor_view/<?php echo $u['Client']['id']; ?>" style="text-decoration:none;"><input type="button" value="View" class="mws-button blue mws-i-24 small"></a></td>
				</tr>
			    <?php } ?>
                            </tbody>
                        </table>
			</form>
                    </div>
                </div>
            </div>