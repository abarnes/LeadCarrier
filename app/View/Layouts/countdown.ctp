<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN"
   "http://www.w3.org/TR/html4/strict.dtd">

<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>MyWeddingConnector</title>
  
  <script src="/js/jquery.js"></script>
  <script src="/js/jquery-ui.js"></script>
  <script src="/js/jquery.countdown.js"></script>
  <script src="/shadowbox/shadowbox.js"></script>
  
  <LINK REL=StyleSheet HREF="/shadowbox/shadowbox.css" TYPE="text/css" MEDIA=screen>

<script type="text/javascript">/*
function two(x) {return ((x>9)?"":"0")+x}
function three(x) {return ((x>99)?"":"0")+((x>9)?"":"0")+x}

function mstime() {
today=new Date()
// arrival (date) has 3 parameters: "today.getFullYear()", (Month - 1), and (Day - 1)
var arrival=new Date(today.getFullYear(), 0, 28,22,30)
var ms=Math.ceil((arrival.getTime()-today.getTime()))
var sec = Math.floor(ms/1000)
ms = ms % 1000
var min = Math.floor(sec/60)
sec= sec % 60
var hr = Math.floor(min/60)
min = min % 60
var day = Math.floor(hr/24)
hr = hr % 24
t = day + ":" + two(hr) + ":" + two(min) + ":" + two(sec)

return t

}

      $(function(){
        $('#counter').countdown({
          image: 'http://jquery-countdown.googlecode.com/svn/trunk/img/digits.png',
          startTime: mstime(),
          timerEnd: function(){
            window.location.replace("/");
          },
        });
      });*/
</script>

<script type="text/javascript">
      $(function(){
        today=new Date()
        $('#counter').countdown({
          image: '../img/digits.png',
          //startTime: '01:12:12:00'
          startTime: new Date(today.getFullYear(), 0, 28,22,30),
          timerEnd: function(){ window.location = "/" }
        });
      });
</script>

<script type="text/javascript">
Shadowbox.init({
    handleOversize: "drag",
    modal: true
});

$(document).ready(function() {
  $("#prt").click(function() {
    var ff = '<div id="party"><p>Sign up for our launch party on January 28th.</p><br/><?php echo $this->Form->create('Vendor', array('action' => 'party'));
    echo $this->Form->input('first_name', array( 'label' => 'First Name: '));
    echo $this->Form->input('last_name', array( 'label' => 'Last Name: '));
    echo $this->Form->input('email', array( 'label' => 'Email: '));
    echo $this->Form->input('phone', array( 'label' => 'Phone: '));
    echo $this->Form->input('businessname', array( 'label' => 'Business Name: '));
    echo $this->Form->input('businessurl', array( 'label' => 'Business URL: '));
    echo $this->Form->input('guests', array( 'label' => 'Number of Guests: ')).'<br/>';
    echo $this->Form->end(array('label'=>'Submit','class'=>'g')); ?><br/></div>';
    // open a welcome message as soon as the window loads
    Shadowbox.open({
        content:    ff,
        player:     "html",
        title:      "Sign Up",
        height:     370,
        width:      450
    });
  });
});
</script>

<style type="text/css">
      br { clear: both; }
      .cntSeparator {
        font-size: 54px;
        margin: 10px 7px;
        color: #000;
      }
      .desc { margin: 7px 3px; }
      .desc div {
        float: left;
        font-family: Arial;
        width: 70px;
        margin-right: 50px;
        padding-left:16px;
        font-size: 13px;
        font-weight: bold;
        color: #000;
       }
       .d {
        width:700px;
        text-align:center;
        margin-right:auto;
        margin-left:auto;
        margin-top:100px;
        border:0px solid rgb(110,163,211);
        font-family:'Calibri','Arial';
      }
      #move {
        position:relative;
        left:100px;
      }
      a {
        text-decoration:none;
        font-size:1.4em;
        font-weight:bold;
        color:#7CB7B5;
      }
      #party {
        height:355px;
        background-color:#ffffff;
        padding:7px;
        font-family:serif;
        text-align:center;
      }
      #party input {
        font-size:1.0em;
        width:200px;
        margin-left:0em;
        margin-top:5px;
    }
    #party p{
      text-align:center;
      color:#333333;
      font-style:italic;
      font-size:1.1em;
    }
    #party label {
      margin-top:5px;
      width:150px;
      color:#333333;
      float: left;
      text-align: right;
      margin-right: 0em;
      display: block
    }
    .g {
      color: #000;
      background: #777777;
      border: 2px outset #d7b9c9
    }
</style>

  </head>
  <body>
  <!------------------------------------------------------
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
-------------------------------------------------------->
        <?php echo $content_for_layout; ?>
  </body>
</html>