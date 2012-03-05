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
			<h2 style="max-width:500px;float:left;"><?php echo $c['Vendor']['name']; ?></h2>
			<div style="float:right;">
				<a href="/vendors/manage"><input type="button" value="Manage Vendors" class="mws-button black mws-i-24 i-apartment-building large"></a>
				<a href="/vendors/edit/<?php echo $c['Vendor']['id']; ?>"><input type="button" value="Edit" class="mws-button green mws-i-24 i-create large"></a>
				<a href="/vendors/delete/<?php echo $c['Vendor']['id']; ?>" onclick="return confirm('Are you sure you want to delete this vendor?  This cannot be undone.')"><input type="button" value="Delete" class="mws-button red mws-i-24 i-cross large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Vendor Information</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <tr class="even">
                                    <td>Name</td>
                                    <td><?php echo $c['Vendor']['name']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Total Leads</td>
                                    <td><?php echo $c['Vendor']['total_all']; ?></td>
                                </tr>
				<tr class="even">
                                    <td>Unbilled Leads</td>
                                    <td><?php echo $c['Vendor']['total_bill']; ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Phone</td>
                                    <td><?php echo $c['Vendor']['phone']; ?></td>
                                </tr>
                                <tr class="even">
                                    <td>Email</td>
                                    <td><?php echo $c['Vendor']['email']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Address</td>
                                    <td>
				    <?php if ($c['Vendor']['address1']!='') { ?>
					<?php echo $c['Vendor']['address1']; ?><br/>
					<?php echo $c['Vendor']['address2']; ?><br/>
					<?php echo $c['Vendor']['city']; ?>, <?php echo $c['Vendor']['state']; ?><br/>
					<?php echo $c['Vendor']['zip']; ?>
				    <?php } ?>
				    </td>
                                </tr>
                                <tr class="even">
                                    <td>Contact Name</td>
                                    <td><?php echo $c['Vendor']['contact_name']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Active</td>
                                    <td><?php if ($c['Vendor']['active']=='1') {
					echo 'yes';
				    } else {
					echo 'no';
				    } ?>
				    </td>
                                </tr>
                                <tr class="even">
                                    <td>Leads per Week</td>
                                    <td>
					    <?php switch ($c['Vendor']['leads_per_week']) {
						case '99999':
							echo 'unlimited';
							break;
						default:
							echo $c['Vendor']['leads_per_week'];
							break;
					    }?>
				    </td>
                                </tr>
				<tr class="odd">
                                    <td>Notes</td>
                                    <td><?php echo $c['Vendor']['notes']; ?></td>
                                </tr>
                            </tbody>
                        </table>
		    </div>
                </div>
		
		<?php if (!empty($c['Range'])) { ?>
		<div class="mws-panel grid_3">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Price Ranges</span>
                    </div>
                    <div class="mws-panel-body">
			<ul class="mws-summary">
				<?php foreach ($c['Range'] as $r) { ?>
					<li><?php echo $r['name']; ?></li>
				<?php } ?>
			</ul>
		    </div>
		</div>
		<?php } ?>
		
		<?php if ($w == 'leads') { ?>
		
		<div class="mws-panel grid_8">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-group-2">Lead History <a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/billing" style="float:right;"><input type="button" value="Billing History" class="mws-button blue mws-i-24 small"></a></span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-datatable-fn mws-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Time Submitted</th>
				    <?php foreach ($fields as $f) {
					echo '<th>'.$f['Field']['display_name'].'</th>';
				    } ?>
                                </tr>
                            </thead>
                            <tbody>
				<?php foreach ($clients as $u) { ?>
				<tr>
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
				</tr>
				<?php } ?>
                            </tbody>
                        </table>
		    </div>
		</div>
		
		<?php } else { ?>
		
		<div class="mws-panel grid_8">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-price-tag">Billing History <a href="/vendors/view/<?php echo $c['Vendor']['id']; ?>/leads" style="float:right;"><input type="button" value="Lead History" class="mws-button blue mws-i-24 small"></a></span>
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
				<?php foreach ($h as $h) { ?>
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
					<?php if ($h['Bill']['paid']=='0') { ?>
					    <a href="/vendors/paid/<?php echo $h['Bill']['id']; ?>" style="text-decoration:none;"><input type="button" value="Mark Paid" class="mws-button blue mws-i-24 small"></a>					
					<?php } else { ?>
					    <a href="/vendors/paid/<?php echo $h['Bill']['id']; ?>" style="text-decoration:none;"><input type="button" value="Mark Unpaid" class="mws-button blue mws-i-24 small"></a>
					<?php } ?>
					<?php if ($h['Bill']['freshbooks_invoice_id']!='') { ?>
					    <a href="/bills/view_freshbooks_bill/<?php echo $h['Bill']['freshbooks_invoice_id']; ?>" target="_blank" style="text-decoration:none;"><input type="button" value="Freshbooks" class="mws-button green mws-i-24 small"></a>	
					<?php } ?>
				    </td>
				</tr>
				<?php } ?>
			</tbody>
			</table>
		    </div>
		</div>
		<?php } ?>
		
		