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
                	<li class="active"><a href="/admin/companies" class="mws-i-24 i-apartment-building">Companies</a></li>
                	<li><a href="/admin/users" class="mws-i-24 i-cog-4">Users</a></li>
			<li><a href="/affiliates" class="mws-i-24 i-link-2">Affiliates</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
        </div>
        
        <div id="mws-container" class="clearfix">
	
	<div class="container">
	    <?php echo $this->Session->flash(); ?>
	    

		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;"><?php echo $c['Company']['name']; ?></h2>
			<div style="float:right;">
				<a href="/admin/companies"><input type="button" value="Manage Companies" class="mws-button black mws-i-24 i-apartment-building large"></a>
				<a href="/companies/edit/<?php echo $c['Company']['id']; ?>"><input type="button" value="Edit" class="mws-button green mws-i-24 i-create large"></a>
				<a href="/admin/companies/delete/<?php echo $c['Company']['id']; ?>" onclick="return confirm('Are you sure you want to delete this company?  This cannot be undone.')"><input type="button" value="Delete" class="mws-button red mws-i-24 i-cross large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-apartment-building">Company Information</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <tr class="even">
                                    <td>Company Name</td>
                                    <td><?php echo $c['Company']['name']; ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Phone</td>
                                    <td><?php echo $c['Company']['phone']; ?></td>
                                </tr>
                                <tr class="even">
                                    <td>Email</td>
                                    <td><?php echo $c['Company']['email']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Address</td>
                                    <td>
				    <?php if ($c['Company']['address1']!='') { ?>
					<?php echo $c['Company']['address1']; ?><br/>
					<?php echo $c['Company']['address2']; ?><br/>
					<?php echo $c['Company']['city']; ?>, <?php echo $c['Company']['state']; ?><br/>
					<?php echo $c['Company']['zip']; ?>
				    <?php } ?>
				    </td>
                                </tr>
                                <tr class="even">
                                    <td>Contact Name</td>
                                    <td><?php echo $c['Company']['contact_name']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>API Token</td>
                                    <td><?php echo $c['Company']['api_token']; ?></td>
                                </tr>
				<tr class="even">
                                    <td>Active</td>
                                    <td><?php if ($c['Company']['active']=='1') {
					echo 'yes';
				    } else {
					echo 'no';
				    } ?>
				    </td>
                                </tr>
				<tr class="odd">
				    <td>Plan</td>
				    <td><?php echo $c['Company']['plan']; ?></td>
				</tr>
				<tr class="even">
                                    <td>Notes</td>
                                    <td><?php echo $c['Company']['notes']; ?></td>
                                </tr>
                            </tbody>
                        </table>
		    </div>
                </div>
		