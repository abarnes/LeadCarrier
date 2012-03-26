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
			<h2 style="max-width:500px;float:left;"><?php echo $c['Client']['first_name'].' '.$c['Client']['last_name']; ?></h2>
			<div style="float:right;">
				<a href="/records/vendor_view"><input type="button" value="All Leads" class="mws-button black mws-i-24 i-group-2 large"></a>
			</div>	
		</div>
		
		<div class="mws-panel grid_5">
		    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-single-user">Information</span>
                    </div>
                    <div class="mws-panel-body">
			<table class="mws-table">
                            <tbody>
                                <?php
				$count = 1;
				foreach ($fields as $f) {
					if ($count%2!=0) {
						$class="even";
					} else {
						$class="odd";
					} ?>
					<tr class="<?php echo $class; ?>">
						<td>
							<?php echo $f['Field']['display_name']; ?>
						</td>
						<td>
							<?php
								switch ($f['Field']['type']) {
									case 'date':
										echo date('m-j-Y',strtotime($c['Client'][$f['Field']['name']]));
										break;
									case 'datetime':
										echo date('g:ia m-j-Y',strtotime($c['Client'][$f['Field']['name']]));
										break;
									case 'tinyint':
										if ($c['Client'][$f['Field']['name']]=='1') {
											echo 'yes';
										} else {
											echo 'no';
										}
										break;
									default:
										if ($f['Field']['name']!='email') {
											echo $c['Client'][$f['Field']['name']];	
										} else {
											echo '<a href="mailto:'.$c['Client'][$f['Field']['name']].'">'.$c['Client'][$f['Field']['name']].'</a>';	
										}
										break;
								}
							
							?>
						</td>
					</tr>
				<?php $count++; } ?>
                            </tbody>
                        </table>
		    </div>
                </div>