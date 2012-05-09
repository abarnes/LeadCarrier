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
			<h2 style="max-width:500px;float:left;"><?php echo $a['Affiliate']['name']; ?></h2>
			<div style="float:right;">
				<a href="/affiliates"><input type="button" value="Manage Affiliates" class="mws-button black mws-i-24 i-link-2 large"></a>
				<a href="/affiliates/edit/<?php echo $a['Affiliate']['id']; ?>"><input type="button" value="Edit" class="mws-button green mws-i-24 i-create large"></a>
				<a href="/affiliates/delete/<?php echo $a['Affiliate']['id']; ?>" onclick="return confirm('Are you sure you want to delete this affiliate?  This cannot be undone.')"><input type="button" value="Delete" class="mws-button red mws-i-24 i-cross large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-apartment-building">Affiliate Information</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <tr class="even">
                                    <td>Name</td>
                                    <td><?php echo $a['Affiliate']['name']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Percentage</td>
                                    <td><?php echo $a['Affiliate']['percentage']; ?>%</td>
                                </tr>
				<tr class="even">
                                    <td>Link</td>
                                    <td>http://leadcarrier.com/a/<?php echo $a['Affiliate']['link']; ?></td>
                                </tr>
                            </tbody>
                        </table>
		    </div>
                </div>
		
		<?php if (!empty($a['Company'])) { ?>
		<div class="mws-panel grid_3">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Companies Referred (<?php echo count($a['Company']); ?> total)</span>
                    </div>
                    <div class="mws-panel-body">
			<ul class="mws-summary">
			    <?php foreach ($a['Company'] as $c) { ?>
				<li><?php echo $c['name']; ?></li>
			    <?php } ?>
			</ul>
		    </div>
		</div>
		<?php } ?>