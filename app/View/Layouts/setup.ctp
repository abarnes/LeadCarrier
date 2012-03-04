<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="/css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/fluid.css" media="screen" />

<link rel="stylesheet" type="text/css" href="/css/mws.style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/icons/icons.css" media="screen" />

<!-- Demo and Plugin Stylesheets -->
<link rel="stylesheet" type="text/css" href="/css/demo.css" media="screen" />

<link rel="stylesheet" type="text/css" href="/plugins/colorpicker/colorpicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/imgareaselect/css/imgareaselect-default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/fullcalendar/fullcalendar.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/fullcalendar/fullcalendar.print.css" media="print" />
<link rel="stylesheet" type="text/css" href="/plugins/chosen/chosen.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/prettyphoto/css/prettyPhoto.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/tipsy/tipsy.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/sourcerer/Sourcerer-1.2.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/jgrowl/jquery.jgrowl.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/plugins/spinner/spinner.css" media="screen" />
<link rel="stylesheet" type="text/css" href="/css/jui/jquery.ui.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="/css/mws.theme.css" media="screen" />

<!-- JavaScript Plugins -->
<script type="text/javascript" src="/js/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="/plugins/imgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="/plugins/duallistbox/jquery.dualListBox-1.3.min.js"></script>
<script type="text/javascript" src="/plugins/jgrowl/jquery.jgrowl-min.js"></script>
<script type="text/javascript" src="/plugins/filestyle/jquery.filestyle-min.js"></script>
<script type="text/javascript" src="/plugins/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="/plugins/datatables/jquery.dataTables-min.js"></script>
<script type="text/javascript" src="/plugins/chosen/chosen.jquery.min.js"></script>
<script type="text/javascript" src="/plugins/prettyphoto/js/jquery.prettyPhoto-min.js"></script>
<!--[if lt IE 9]>
<script type="text/javascript" src="/plugins/flot/excanvas.min.js"></script>
<![endif]-->
<script type="text/javascript" src="/plugins/flot/jquery.flot.min.js"></script>
<script type="text/javascript" src="/plugins/flot/jquery.flot.pie.min.js"></script>
<script type="text/javascript" src="/plugins/flot/jquery.flot.stack.min.js"></script>
<script type="text/javascript" src="/plugins/flot/jquery.flot.resize.min.js"></script>
<script type="text/javascript" src="/plugins/colorpicker/colorpicker-min.js"></script>
<script type="text/javascript" src="/plugins/tipsy/jquery.tipsy-min.js"></script>
<script type="text/javascript" src="/plugins/sourcerer/Sourcerer-1.2-min.js"></script>
<script type="text/javascript" src="/plugins/placeholder/jquery.placeholder-min.js"></script>
<script type="text/javascript" src="/plugins/validate/jquery.validate-min.js"></script>
<script type="text/javascript" src="/plugins/spinner/jquery.mousewheel-min.js"></script>
<script type="text/javascript" src="/plugins/spinner/ui.spinner-min.js"></script>
<script type="text/javascript" src="/js/jquery-ui.js"></script>

<script type="text/javascript" src="/js/demo.js"></script>
<script type="text/javascript" src="/js/mws.js"></script>
<script type="text/javascript" src="/js/themer.js"></script>

<title>Lead Carrier - Administration</title>

</head>
<body>

	<!-- Header Wrapper -->
	<div id="mws-header" class="clearfix">
    
    	<!-- Logo Wrapper -->
    	<div id="mws-logo-container">
        	<div id="mws-logo-wrap">
			<img src="/images/logo.png" alt="mws admin" />
		</div>
        </div>
        
        <!-- User Area Wrapper -->
        <div id="mws-user-tools" class="clearfix">
            
        </div>
    </div>
    
	    
    
    <!-- Main Wrapper -->
    <div id="mws-wrapper">
    	<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
        
            <?php echo $this->fetch('content'); ?>
        
          <!-- Footer -->
            <div id="mws-footer">
            	Copyright Lead Carrier 2012. All Rights Reserved.
            </div>
            <!-- End Footer -->
            
        </div>
        <!-- End Container Wrapper -->
        
    </div>
    <!-- End Main Wrapper -->

</body>
</html>
