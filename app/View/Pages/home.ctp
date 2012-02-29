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

<!-- Container Start-->
<div class="container_16" style="padding-left:15px;">
	
    <div id="topdot" class="grid_16 margin"></div>
    
    <!-- Navigation Start-->
    <div id="navigation" class="grid_16 margin">
        
        <!-- #Logo-->
        <div class="grid_4 logo margin">
        	<a href="#"><img src="image/theme/colorlogo.jpg" alt="" style="width:350px;margin-top:30px;"></a>
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
    	
    	<!--Arrow Navigation-->
    	<a id="prevslide" class="load-item"><img src="image/theme/arrow1.png" alt=""></a>
    	<a id="nextslide" class="load-item"><img src="image/theme/arrow2.png" alt=""></a>
    	
        <!--Slide captions displayed here-->
        <div id="slidecaption">
		  <script>
            jQuery(function($){			
                    $.supersized({			
                        // Functionality
                        slide_interval          :   5000,		// Length between transitions
                        transition              :   1, 			// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
                        transition_speed		:	1000,		// Speed of transition															   
                        // Components							
                        slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
                        slides 					:  	[			// Slideshow Images	
                        {image : 'image/wall/01.jpg', title : ''}/*,
			{image : 'image/wall/01.jpg', title : '<h1>Lead Carrier</h1> <h2>"Lead Distribution. Simplified."</h2>'}/*,
                        {image : 'image/wall/02.jpg', title : '<h1>The New York City</h1> <h2>"Duis eleifend suscipit pellentesque"</h2>'},
						{image : 'image/wall/03.jpg', title : '<h1>A Black Night in The City</h1> <h2>"Vivamus euismod luctus tempus"</h2>'},
						{image : 'image/wall/04.jpg', title : '<h1>New World in The City</h1> <h2>"Nulla augue urna, dictum eu luctus"</h2>'}*/												
                                                    ]	
                    });
                });
          </script>
        </div>
		
        <!--Navigation-->
    	<div id="list-slide">
        <ul id="slide-list"></ul>
    	</div>
        
    	<!--Time Bar-->
    	<div id="progress-back" class="load-item">
    	    <div id="progress-bar"></div>
    	</div>
    </div>
    <!-- Slider End-->
    
    <!-- Clear-->
    <div class="clear"></div>
    
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
            <li> <a href="#work" class="tabbutton1 first selected"> <img src="image/icon/1.png" alt=""> <h1> Work Portfolio </h1> <p>Lorem ipsum is simply</p></a> </li>
            <li><a href="#aboutus" class="tabbutton2"><img src="image/icon/2.png" alt=""> <h1> About We Us </h1> <p>Lorem ipsum is simply</p></a> </li>
            <li><a href="#team" class="tabbutton3"><img src="image/icon/3.png" alt=""> <h1> Creative Team </h1> <p>Lorem ipsum is simply</p></a> </li>
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
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">Work Portfolio One</a></h1>
                        <img src="image/post/col1.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Two Is Here</a></h1>
                        <img src="image/post/c1.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Three Is Here</a></h1>
                        <img src="image/post/c2.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Four Is Here</a></h1>
                        <img src="image/post/c3.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Five Is Here</a></h1>
                        <img src="image/post/c4.png" alt="" class="three-columb-img">
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
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">Work Portfolio Two</a></h1>
                        <img src="image/post/col2.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Two Is Here</a></h1>
                         <img src="image/post/c5.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Three Is Here</a></h1>
                         <img src="image/post/c6.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Four Is Here</a></h1>
                         <img src="image/post/c7.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Five Is Here</a></h1>
                         <img src="image/post/c8.png" alt="" class="three-columb-img">
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
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">Work Portfolio Three</a></h1>
                        <img src="image/post/col3.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Two Is Here</a></h1>
                         <img src="image/post/c9.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Three Is Here</a></h1>
                         <img src="image/post/c10.png" alt="" class="three-columb-img">
                    </div>
                    </li>
                    <li>
                    <div class="columb-shadow"><img src="image/theme/minishadow.png" alt=""></div>
                    <div class="corner_ribbon">
                        <div class="corner_ribbon_top_left_black"><a href="image/post/bigimage.png" title="Lorem ipsum is simply dummy data text printing." class="team corner_zoom"></a></div>
                        <h1><a href="#">The Title Four Is Here</a></h1>
                         <img src="image/post/c11.png" alt="" class="three-columb-img">
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
                <h1>Why do we use it?</h1>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p> <p>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing.</p>
                <div class="margin1"><a href="#" class="minibutton">More</a></div>
              </div>
          </div>
          
          <!-- #3 -->
          <div id="team" class="tab-content">
              <div class="home-team">
              	<ul>
                	<li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="John Smith (General Manager) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t1.png" alt="" class="home-team-img"></a><h1>John Smith</h1><p>General Menager</p></li>
                    <li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="Marry Anderson (Ass. Manager) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t2.png" alt="" class="home-team-img"></a><h1>Marry Anderson</h1><p>Ass. Manager</p></li>
                    <li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="Micheal Fisher (Graphicer) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t3.png" alt="" class="home-team-img"></a><h1>Micheal Fisher</h1><p>Graphicer</p></li>
                    <li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="Alexsandra Smith (Personel Manager) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t4.png" alt="" class="home-team-img"></a><h1>Alexsandra Smith</h1><p>Personel Manager</p></li>
                    <li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="Matheus Prahk (Code Developer) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t5.png" alt="" class="home-team-img"></a><h1>Matheus Prahk</h1><p>Code Developer</p></li>
                    <li><div class="columb-shadow2"><img src="image/theme/minishadow3.png" alt=""></div><a class="team" href="image/post/bigimage.png" title="Philips Garden (Online Support) </br>Lorem ipsum is simply dummy data text printing"><img src="image/post/t6.png" alt="" class="home-team-img"></a><h1>Philips Gorden</h1><p>Online Support</p></li>
                </ul>
              </div>
              <div class="clear"></div>
              <div class="home-team-bottom">
              <div class="margin2 fleft"><a href="#" class="minibutton">View All Team</a></div>
              <h1>Since 1947-2012</h1>
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
        <div class="margin3 fright"><a href="http://demo.leadcarrier.com" target="_new" class="minibutton">Live Demo</a></div>
    </div>
    <!-- Advert End -->
    
    <!-- Clear-->
    <div class="clear"></div>
    
    
    <!-- What Says Our Company -->
    <div class="grid_8 margin leftsays">
    	<div id="full-bottom"></div>
    	<div class="title-2cloumb">
        	<h1>What Says Our Company</h1>
        	<p>Lorem ipsum is simply data text</p>
        </div>
        <div class="leftcloumb-list">
        	<ul>
            	<li><div class="margin4 fright"><</div><img src="image/post/say1.png" alt="" class="leftcloumb-list-img"> <h1>William Crahenberg Says:</h1><p>“Lead Carrier was able to get us setup in hours and handled all the traffic we threw at it without skipping a beat.”</p></li>
                <li><div class="margin4 fright"></div><img src="image/post/say2.png" alt="" class="leftcloumb-list-img"> <h1>Marie Smith Do Says:</h1><p>“I was running hundreds of leads through this system a day and I never had an issue. Very impressed with the system”</p></li>
                <li><div class="margin4 fright"></div><img src="image/post/say3.png" alt="" class="leftcloumb-list-img"> <h1>Mark John Gothenberg Says:</h1><p>“Fair pricing. Check. Awesome feature listings. Check. Great customer service. Check.  This is the total package, I’d recommend it to anyone.”</p></li>
            </ul>
        </div>
    </div>
    <!-- What Says Our Company End -->
    
    <!-- Bigg Boss -->
    <div class="grid_8 margin">
    	<div class="title-2cloumb">
        	<h1>The Big Boss Says</h1>
        	<p>Lorem ipsum is simply printing swith data text</p>
        </div>
        <div class="bussiness-boss">
            <img src="image/post/biggboss.png" class="bussiness-boss-img" alt="">
            <div class="bussiness-shadow"><img src="image/theme/bigshadow2.png" alt=""></div>
            <h1>Micheal Smith Fisher:</h1>
            <p>"Phasellus dapibus rutrum mi, sed elementum felis placerat ac. Aenean gravida elementum arcu non ultrices. Proin pharetra ipsum vitae augue dignissim pharetra. Maecenas turpis leo, dignissim a elementum id, feugiat eget leo. Ut vitae neque aliquam orci blandit elementum eu id nibh. Class aptent taciti sociosqu ad litora."</p>
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
        	<p>Copright © 2012 City Themes iamthemes.com. All rights reserved. W3C standart web site valid xhtml and css</p><p>Design by Mithat Sigmaz / <a href="http://www.cubegraphic.net">CUBE GRAPHIC</a> - Code by IAMILKAY / <a href="http://www.iamthemes.com">IAMTHEMES</a></p>
        </div>
    </div>
</div>
</div>
</body>
</html>