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
		