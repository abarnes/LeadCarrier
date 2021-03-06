<!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>City Business Theme</title>

<!-- Style CSS -->
<link rel="stylesheet" href="css/grid/main.css" />

<!-- Google Font -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Mate+SC' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=PT+Sans+Narrow' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Marvel' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet'>
<link href='http://fonts.googleapis.com/css?family=Cabin:400italic' rel='stylesheet'>

<!-- JS Min -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script src="js/general.js"></script>
<script src="js/full.js"></script>

<!-- JS Theme Style -->
<script>
if (document.layers) { document.write('<link rel=stylesheet href="css/style/style.css">') } 
else { document.write('<link rel=stylesheet href="css/style/style.css">') }
if (document.layers) { document.write('<link rel=stylesheet href="css/color/default.css">') } 
else { document.write('<link rel=stylesheet href="css/color/default.css">') }
if (document.layers) { document.write('<link rel=stylesheet href="css/app/supersized.css">') } 
else { document.write('<link rel=stylesheet href="css/app/supersized.css">') }
if (document.layers) { document.write('<link rel=stylesheet href="css/app/hover_effects.css">') } 
else { document.write('<link rel=stylesheet href="css/app/hover_effects.css">') }
if (document.layers) { document.write('<link rel=stylesheet href="./fancybox/jquery.fancybox-1.3.4.css">') } 
else { document.write('<link rel=stylesheet href="./fancybox/jquery.fancybox-1.3.4.css">') }
</script>

<!--[if lt IE 10]>
<link rel="stylesheet" href="css/app/hover_effects_ie.css" type="text/css" media="screen" />
<link rel="stylesheet" href="css/style/ie9.css" type="text/css" media="screen" />
<![endif]-->

<script src="./fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script src="./fancybox/jquery.fancybox-1.3.4.pack.js"></script>

</head>
<body>
<div style="background-image:url('img/background-slide.jpg');background-repeat: none;background-size: cover;height:700px;">

    <!-- Container Start-->
    <div class="container_16" style="padding-left:15px;">
	    
	<div id="topdot" class="grid_16 margin"></div>
	
	<a href="/login" style="position:absolute;top:20px;margin-left:880px;"><input type="submit" value="login" class="minibutton-black"></a>
	
	<!-- Navigation Start-->
	<div id="navigation" class="grid_16 margin">
	    
	    <!-- #Logo-->
	    <div class="grid_4 logo margin">
		    <a href="/"><img src="img/colorlogo.png" alt="Lead Carrier - The Most Affordable Full-Service Lead Distribution Platform" style="width:360px;margin-top:26px;"></a>
	    </div>
	    
	    <!-- #Menu-->
	    <div class="grid_12 topmenu">
		    <ul id="menu">
		    <li><a href="/">Home</a></li>
		    <li><a href="/pricing">Pricing</a></li>
		    <li><a href="/features">Features</a></li>
		    <li><a href="/contact">Contact</a></li>
		</ul>
	    </div>        
	</div>
	
	<!-- Slider Start-->
	<div id="slider" class="grid_16">
	    <img src="img/home.png" style="width:820px;margin-left:60px;margin-right: 60px;margin-top:45px;"/>
	    <!--<a href="http://demo.leadcarrier.com/users/demo_login" target="_blank"><img src="img/launchdemo.png" style="margin-top:-90px;margin-left:70px;width:340px;"/></a>-->
	    <a href="/pricing"><img src="img/trialbutton.png" style="margin-top:-90px;margin-left:70px;width:340px;"/></a>
	    <a href="http://demo.leadcarrier.com/users/demo_login" target="_blank" style="margin-top:-90px;margin-left:236px;position: relative;bottom: 30px;color:white;font-size: 1.3em;">View Demo</a>
	</div>
	<!-- Slider End-->
	
	<!-- Clear-->
	<div class="clear"></div>
    
    </div>
</div>
<div class="container_16" style="padding-left:15px;margin-top:-100px;">
    
    <!-- Tab Menu Start-->
    <div id="tabmenu" class="grid_16 margin">
      
      <div id="tab-gradident"></div>
      <div id="tabback"></div>
      <div id="tabmenuback"></div>
      <script type="text/javascript">
      $(document).ready(function() {
          $('#classytabs').classytabs({ root: '', rootlink: '',showbreadcrumb:true,ontabclick:function(tab){
          if(tab == 'portfolio')							
              $('#pages').smartpaginator({ totalrecords: 3,recordsperpage: 1, datacontainer: 'my-contents', dataelement: 'div', theme: 'black' });
                      } });            
         
      });	
      </script>
      
      <div id="tabmainmenu" class="grid_16 margin">
      	  <div class="big-shadow"><img src="image/theme/bigshadow.png" alt=""></div>
          <div id="classytabs">
            <!-- Tab Menu-->
            <ul class="tabs">
	    <li><a href="#team" class="tabbutton1"><img src="image/icon/3.png" alt=""> <h1> Endorsements </h1></a><p></p> </li>
            <li><a href="#aboutus" class="tabbutton2"><img src="image/icon/2.png" alt=""> <h1> About Us </h1></a> </li>
	    <li> <a href="#work" class="tabbutton3 first selected"> <img src="image/icon/1.png" alt=""> <h1> Product Tour </h1></a> </li>
            </ul>        
          <div class="clearfix"></div>
          
          <!-- Tab Menu Content-->
          <div id="tabs-content" class="tab-contents" style="width:970px;">
          
          <!-- TAB MENU CONTENT #1 -->
          <div id="work" class="tab-content">
              
              <!-- #1 -->
              <div class="three-columb">
              	<script>
				$(function(){				
				
				  $('#columb').bxSlider({
					  mode: 'fade',
					  captions: true,
					  auto: false,
					  controls: true
				  });
				  
				  $('#columb2').bxSlider({
					  mode: 'fade',
					  captions: true,
					  auto: false,
					  controls: true
				  });
				  
				  $('#columb3').bxSlider({
					  mode: 'fade',
					  captions: true,
					  auto: false,
					  controls: true
				  });
				});	
			   </script>
              	<ul id="columb" class="columb-post">
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="img/screenshots/dashboard.jpg" title="The Lead Carrier Dashbaord" class="team corner_zoom"></a></div>
                        <h1><a href="#">Dashboard</a></h1>
                        <img src="img/screenshots/dashboard.jpg" alt="" class="three-columb-img">
                    </div>
                    </li>
                </ul>
              </div>
              
              <!-- #2 -->
              <div class="three-columb">
              	<ul id="columb2" class="columb-post">
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="img/screenshots/industries.jpg" title="Easily group your vendors into industries, and manage industry price ranges." class="team corner_zoom"></a></div>
                        <h1><a href="#">Management</a></h1>
                        <img src="img/screenshots/industries.jpg" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="img/screenshots/vendors.jpg" title="Manage vendors easily, and allow your vendors to log in and view their leads and invoices." class="team corner_zoom"></a></div>
                        <h1><a href="#">Simple Organization</a></h1>
                         <img src="img/screenshots/vendors.jpg" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="img/screenshots/settings.jpg" title="Customize your account settings to fit your business, and " class="team corner_zoom"></a></div>
                        <h1><a href="#">Customized for your needs</a></h1>
                         <img src="img/screenshots/settings.jpg" alt="" class="three-columb-img">
                    </div>
                    </li>
                </ul>
              </div>
              
              <!-- #3 -->
              <div class="three-columb">
              	<ul id="columb3" class="columb-post">
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="img/screenshots/pending.jpg" title="Screen leads before sending them to your vendors to ensure quality." class="team corner_zoom"></a></div>
                        <h1><a href="#">Operations</a></h1>
                        <img src="img/screenshots/pending.jpg" alt="" class="three-columb-img">
                    </div>
                    </li>
                </ul>
              </div>
          </div>
          
          <!-- TAB MENU CONTENT #2 -->
          <div id="aboutus" class="tab-content">
              <div class="homepage-team">
              	<div class="columb-shadow"><img src="image/theme/minishadow2.png" alt=""></div>
              	<img src="image/post/middle.png" class="homepage-team-img" alt="">
                <h1>The Company</h1>
                <p> The Lead Carrier team is compiled of Tech Wizards and Internet Marketers. After realizing a serious need in the lead distribution industry while running our own campaigns, we built a reliable system that can handle whatever amount of traffic you drive to your site. Since implementing the system on our own businesses, we've perfected the simple lead distribution system. Schedule a live demo and let us walk you through the functionality of Lead Carrier today!</p>
                <!--<div class="margin1"><a href="#" class="minibutton">More</a></div>-->
              </div>
          </div>
          
          <!-- #3 -->
          <div id="team" class="tab-content">
              <div class="homepage-team">
                <h1>Recommended By</h1>
                <table style="width:100%;margin-top:-10px;">
		    <tr>
			<td style="width:25%;"><a href="http://www.guerillaconsultant.com" target="_blank"><img src="/img/endorsements/guerilla.png" style="width:185px;"/></a></td>
			<td style="width:25%;"><a href="http://www.orderofthekey.org" target="_blank"><img src="/img/endorsements/otk.png" style="width:215px;margin-top: 50px;"/></a></td>
			<td style="width:25%;"><a href="http://www.advertiser360.com" target="_blank"><img src="/img/endorsements/a360.png" style="width:215px;margin-top: 70px;"/></a></td>
			<td style="width:25%;"><a href="http://www.myweddingconnector.com" target="_blank"><img src="/img/endorsements/mwc.png" style="width:215px;margin-top: 55px;"/></a></td>
		    </tr>
		</table>
              </div>
          </div>
          </div>
        </div>
    </div>
    <!-- Tab Menu End-->
    
    <!-- Clear-->
    <div class="clear"></div>
    
    <!-- Advert Start -->
    <div id="advert" class="grid_16 advert">
    	<div id="advertback"></div>
        <h1>"We were sold when we saw the demo."</h1>
        <div class="margin3 fright"><a href="http://demo.leadcarrier.com/users/demo_login" target="_new" class="minibutton">Live Demo</a></div>
    </div>
    <!-- Advert End -->
    
    <!-- Clear-->
    <div class="clear"></div>
    
    
    <!-- What Says Our Company -->
    <div class="grid_8 margin leftsays">
    	<div id="full-bottom"></div>
    	<div class="title-2cloumb">
        	<h1>What people are saying...</h1>
        	<p></p>
        </div>
        <div class="leftcloumb-list">
        	<ul>
            	<li><div class="margin4 fright"></div><img src="image/post/t3.png" alt="" class="leftcloumb-list-img"> <h1>Kyle M. Says:</h1><p>“Lead Carrier was able to get us setup in hours and handled all the traffic we threw at it without skipping a beat.”</p></li>
                <li><div class="margin4 fright"></div><img src="image/post/testimonial2.jpg" alt="" class="leftcloumb-list-img"> <h1>Robert Q. B. Says:</h1><p>“I was running hundreds of leads through this system a day and I never had an issue. Very impressed with the system”</p></li>
                <li><div class="margin4 fright"></div><img src="image/post/testimonial3.jpg" alt="" class="leftcloumb-list-img"> <h1>Mark G. Says:</h1><p>“Fair pricing. Check. Awesome feature listings. Check. Great customer service. Check.  This is the total package, I’d recommend it to anyone.”</p></li>
            </ul>
        </div>
    </div>
    <!-- What Says Our Company End -->
    
    <!-- Bigg Boss -->
    <div class="grid_8 margin">
    	<div class="title-2cloumb">
        	<h1>Advertiser360 Official Partner</h1>
        	<p>Lead Carrier is the #1 recommended Lead Distribution software of Advertiser360</p>
        </div>
        <div>
            <img src="/img/PeterNguyen.jpg" alt="Lead Carrier endorsed by Advertising 360" style="width:160px;float:left;-webkit-border-radius: 12px;-moz-border-radius: 12px;border-radius: 12px;">
		<div style="float:right;width:280px;height:270px;">
		    <h1>Peter Nguyen</h1><br/>
		    <p style="font-size: 1.2em;line-height: 1.7em;">"I recommend Lead Carrier to anyone who wants to launch the next major lead generation company. Lead Carrier is lean yet powerful and is the perfect backend office for a starting lead generation company with plans to grow."</p>
		</div>
		<a href="http://www.advertiser360.com" target="_blank"><img src="/img/endorsements/a360.png" style="float:left;margin-left:100px;"/></a>
        </div>
    </div>
    <!-- Bigg Boss End -->
    
    
</div>
<!-- Container End-->

<!-- Clear-->
<div class="clear"></div>     

<!-- Footer 2 Start -->       
<div id="footer2-back" style="margin:0px;">
	<div class="container_16">
    	<div class="grid_16 footerregister margin">
        	<p>Copright © 2012 Lead Carrier LLC</p>
		<span style="float:right;"><a style="margin-right:15px;" href="/pages/termsandconditions">Terms & Conditions</a><a href="/pages/privacy">Privacy Policy</a></span>
        </div>
    </div>
</div>
</div>
</body>
</html>