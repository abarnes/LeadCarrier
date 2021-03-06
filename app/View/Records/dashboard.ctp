<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<?php if ($go=='1') { ?>
	<!-----chart function ---->
	<script type="text/javascript">
	$(function () {
	    var Leads = [];
	    var mult=0;
	    
	    <?php $leads=0; ?> 
	    <?php foreach ($dat as $d) { ?>
		mult = <?php echo $d['date']; ?>;
		Leads.push([mult*1000, <?php echo $d['leads']; ?>]);
		<?php $leads=$leads+$d['leads']; ?>
	    <?php } ?>
		//alert(Leads);
	    var plot = $.plot($("#mws-dashboard-chart"),
		   [ { data: Leads, label: "Leads Generated", color: "#c5d52b"} ], {
		       series: {
			   lines: { show: true },
			   points: { show: true }
		       },
		       grid: { hoverable: true, clickable: true },
		       //xaxis: { min: 1, max: 31 },
			xaxis: {
				mode: "time",
				minTickSize: [1, "day"],
				min: (new Date(<?php echo $starttime; ?>/*2012, 0, 12*/)).getTime(),
				max: (new Date(<?php echo $endtime; ?>/*2012, 1, 12*/)).getTime()
			},
		       yaxis: { min: 0, max: <?php echo $max; ?> }
		     });
	});
	</script>
	
	<script>
		$(function() {
			$( ".datepicker" ).datepicker();
			$('#gr').visualize({type: 'area', width: '730px',height:'300px'});
			$('.subm').corner();
		});
	</script>
<?php } ?>

<!-- Sidebar Wrapper -->
        <div id="mws-sidebar">
        	
            <!-- Search Box -->
        	<!--<div id="mws-searchbox" class="mws-inset">
            	<form action="dashboard.html">
                	<input type="text" class="mws-search-input" />
                    <input type="submit" class="mws-search-submit" />
                </form>
            </div>-->
            <br/>
            
            <!-- Main Navigation -->
            <div id="mws-navigation">
            	<ul>
                	<li class="active"><a href="/dashboard" class="mws-i-24 i-home">Dashboard</a></li>
			<li>
				<a href="/pending" class="mws-i-24 i-plus">
					Pending <span class="mws-nav-tooltip">+<?php if (isset($pendings)) {echo $pendings; } else { echo '0'; }?></span>
				</a>
			</li>
                	<li><a href="/clients" class="mws-i-24 i-group-2">Clients</a></li>
                	<li><a href="/vendors/manage" class="mws-i-24 i-apartment-building">Vendors</a></li>
                	<li><a href="/categories" class="mws-i-24 i-companies">Industries</a></li>
                	<li><a href="/settings" class="mws-i-24 i-cog-4">Admin</a></li>
                </ul>
            </div>
            <!-- End Navigation -->
            
        </div>
        
        <!-- Container Wrapper -->
        <div id="mws-container" class="clearfix">
        
        	<!-- Main Container -->
            <div class="container">
	    <?php echo $this->Session->flash(); ?>
	    
		<div style="float:left;width:100%;">
			<h2 style="max-width:500px;float:left;">Dashboard <?php if ($go=='1') {echo ' - '.$nam;} ?></h2>
			<?php if ($go=='1') { ?>
				<div style="float:right;">
					<div class="dateform">
						<table>
						    <tr>
							<td>
								<?php echo $this->Form->create('Record', array('action' => 'dashboard'));
								echo $this->Form->input('start_date', array( 'label' => '<span class="datelabel">Start Date: </span>','class'=>'datepicker')); ?>
							</td>
							<td>
								<?php echo $this->Form->input('end_date', array('label'=>'<span class="datelabel">End Date: </span>','class'=>'datepicker')); ?>
							</td>
							<td>
								<?php echo $this->Form->end(array('label'=>'Submit','class'=>'mws-button black')); ?>
							</td>
						    </tr>
						</table>
					    </div>
				</div>
			<?php } ?>
		</div>
		
            	<div class="mws-report-container clearfix">
		
			<a class="mws-report" href="/clients/pending">
                    	<span class="mws-report-icon mws-ic ic-user-add"></span>
                        <span class="mws-report-content">
                        	<span class="mws-report-title">Pending</span><br/>
                            <span class="mws-report-value"><?php if (isset($pendings)) {echo $pendings; } else { echo '0'; }?></span>
                        </span>
                    </a>		    
                    		
		
                	<a class="mws-report" href="/clients">
                    	<span class="mws-report-icon mws-ic ic-group-link"></span>
                        <span class="mws-report-content">
                        	<span class="mws-report-title">Total Sign-Ups</span><br/>
                            <span class="mws-report-value"><?php if (isset($brides)) {echo $brides; } else { echo '0'; }?></span>
                        </span>
                    </a>

                	<a class="mws-report" href="#">
                    	<span class="mws-report-icon mws-ic ic-chart-line"></span>
                        <span class="mws-report-content">
                        	<span class="mws-report-title">Leads Generated</span><br/>
                            <span class="mws-report-value"><?php if (isset($leads)) {echo $leads; } else { echo '0'; }?></span>
                        </span>
                    </a>
		    
		        <a class="mws-report" href="/vendors/manage">
                    	<span class="mws-report-icon mws-ic ic-small-business"></span>
                        <span class="mws-report-content">
                        	<span class="mws-report-title">Active Vendors</span><br/>
                            <span class="mws-report-value"><?php echo $active_vendors; ?></span>
                        </span>
                    </a>
                    
                	<a class="mws-report" href="#">
                    	<span class="mws-report-icon mws-ic ic-money-add"></span>
                        <span class="mws-report-content">
                        	<span class="mws-report-title">Revenue Generated</span><br/>
                            <span class="mws-report-value">$<?php if (isset($rev)) {echo $rev; } else { echo '0'; }?></span>
                        </span>
                    </a>		    
		    
                </div>
                
	<?php if ($go=='1') { ?>
            	<div class="mws-panel grid_5">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Leads</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
	                    	<div id="mws-dashboard-chart" style="width:100%; height:302px;"></div>
                        </div>
                    </div>
                </div>
                
            	<div class="mws-panel grid_3">
                	<div class="mws-panel-header">
                    	<span class="mws-i-24 i-books-2">Industry Statistics</span>
                    </div>
                    <div class="mws-panel-body">
                        <ul class="mws-summary">
			    <?php
			    if (isset($ind)) {
				foreach ($ind as $i) {
					echo '<li>';
						echo '<span>'.round($i['perc'],1).'%</span>'.$i['Category']['name'].' ('.$i['leads'].')';
					echo '</li>';
				}
			    } else {
				echo '<li>You need to add industries to view statistics</li>';
			    }?>
                        </ul>
                    </div>
                </div>
	<?php } else { ?>
		<div class="mws-panel grid_8">
                    <div class="mws-panel-header">
                    	<span class="mws-i-24 i-graph">Get Started</span>
                    </div>
                    <div class="mws-panel-body">
                    	<div class="mws-panel-content">
	                    	<h4><ol>
					<li><a href="/categories/add" style="text-decoration:none;color:#323232;">Create Industries & Price Ranges</a></li>
					<li><a href="/vendors/sel" style="text-decoration:none;color:#323232;">Add Vendors</a></li>
					<li><a href="/companies/api" style="text-decoration:none;color:#323232;">Integrate with Your Site</a></li>
					<li>Start Distributing Leads!</li>
				</ol></h4>
                        </div>
                    </div>
                </div>
	<?php } ?>
		
            <!-- End Main Container -->