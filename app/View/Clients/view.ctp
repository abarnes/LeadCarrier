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
                	<li class="active"><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
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
			<h2 style="max-width:500px;float:left;"><?php echo $c['Client']['first_name'].' '.$c['Client']['last_name']; ?></h2>
			<div style="float:right;">
				<?php if ($c['Client']['approved']=='0') { ?>
					<a href="/pending"><input type="button" value="All Pending" class="mws-button black mws-i-24 i-plus large"></a>
				<?php } else { ?>
					<a href="/clients"><input type="button" value="Manage Clients" class="mws-button black mws-i-24 i-group-2 large"></a>
				<?php } ?>
				<a href="/clients/delete/<?php echo $c['Client']['id']; ?>" onclick="return confirm('Are you sure you want to delete this person?  This cannot be undone.')"><input type="button" value="Delete" class="mws-button red mws-i-24 i-cross large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-companies">Information</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <tr class="even">
                                    <td>Name</td>
                                    <td><?php echo $c['Client']['first_name'].' '.$c['Client']['last_name']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>ID</td>
                                    <td><?php echo $c['Client']['id']; ?></td>
                                </tr>
				<tr class="even">
                                    <td>Date/Time Submitted</td>
                                    <td><?php echo date('g:ia m-j-Y',strtotime($c['Client']['created'])); ?></td>
                                </tr>
                                <tr class="odd">
                                    <td>Phone</td>
                                    <td><?php echo $c['Client']['phone']; ?></td>
                                </tr>
                                <tr class="even">
                                    <td>Email</td>
                                    <td><?php echo $c['Client']['email']; ?></td>
                                </tr>
				<tr class="odd">
                                    <td>Zipcode</td>
                                    <td><?php echo $c['Client']['zip']; ?></td>
                                </tr>
                            </tbody>
                        </table>
		    </div>
                </div>
		
		<?php if ($c['Client']['approved']=='1') { ?>
		<div class="mws-panel grid_8">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-table-1">Leads Sent</span>
                    </div>
                    <div class="mws-panel-body">
                        <table class="mws-table">
                            <thead>
                                <tr>
                                    <th>Industry</th>
                                    <th>Vendor 1</th>
                                    <th>Vendor 2</th>
                                    <th>Vendor 3</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
				$arr = array();
				foreach ($c['Record'] as $u) {
				    if ($u['select']=='1') {
					$arr['c'.$u['category_id']][] = $u['vendor_id'];
				    }
				}
				
				$g = 1;
				foreach ($arr as $row=>$u) {
				    
				    if ($g%2>0) {
					$class = 'even';
				    } else {
					$class = 'odd';
				    }
				    $g++;
				?>
				<tr class="<?php echo $class; ?>">
				    <td>
					<?php
					$cat = substr($row,1);
					if (array_key_exists($cat,$cats)) {
					    echo $cats[$cat];
					} else {
					    echo '[Deleted Industry]';
					} ?>
				    </td>
				    <td>
					<?php
					    if ($u[0]!='') {
						echo $v[$u[0]];
					    } else {
						echo 'Empty';
					    }
					?>
				    </td>
				    <td>
					<?php
					    if ($u[1]!='') {
						echo $v[$u[1]];
					    } else {
						echo 'Empty';
					    }
					?>
				    </td>
				    <td>
					<?php
					    if ($u[2]!='') {
						echo $v[$u[2]];
					    } else {
						echo 'Empty';
					    }
					?>
				    </td>
				</tr>
				<?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
		<?php } ?>