        <!-- Clear -->
    	<div class="clear"></div>
	<?php echo $this->Session->flash(); ?>
	
    <!-- What Says Our Company -->
    <div class="grid_8 margin leftsays">
    	<div id="full-bottom2"></div>
        <div class="title-2cloumb">
        	<h1>Contact Details</h1>
        </div>
        <div class="leftcloumb-list">
        	<ul>
            	<li><img src="image/icon/a1.png" alt="" class="leftcloumb-list-img"> <h1>Address:</h1><p>1000 S. 35E<br/>Dallas, TX 75287</p></li>
                <li><img src="image/icon/a2.png" alt="" class="leftcloumb-list-img"> <h1>Telephone:</h1><p>(555) 555-5555</p></li>
                <li><img src="image/icon/a3.png" alt="" class="leftcloumb-list-img"> <h1>E-Mail</h1><p><a href="mailto:info@leadcarrier.com">info@leadcarrier.com</a></a></p></li>
            </ul>
        </div>    
    </div>
    <!-- What Says Our Company End -->
    
    <!-- Bigg Boss -->
    <div class="grid_8 margin">
    	<div class="title-2cloumb">
        	<h1>Send us a Message</h1>
        </div>
        <div class="comment-form margin">
	    <?php echo $this->Form->create('Contact',array('action'=>'submit'),array('div'=>false)); ?>
            <fieldset><input name="data[Contact][name]" id="ContactName" type="text" value="Name:" onfocus="if(this.value=='Name:')this.value='';" onblur=	"if(this.value=='')this.value='Name:';"/></fieldset>  
            <fieldset><input name="data[Contact][email]" id="ContactEmail" type="text" value="E-Mail:" onfocus="if(this.value=='E-Mail:')this.value='';" onblur=	"if(this.value=='')this.value='E-Mail:';"/></fieldset>
            <fieldset><input name="data[Contact][company]" type="text" value="Company:" onfocus="if(this.value=='Company:')this.value='';" onblur=	"if(this.value=='')this.value='Company:';"/></fieldset>
            <fieldset><textarea name="data[Contact][message]" onfocus="if(this.value=='Message:')this.value='';" onblur=	"if(this.value=='')this.value='Message:';">Message:</textarea></fieldset>
            <div class="fright"><fieldset><input type="submit" value="Send" /></fieldset></div>
	    </form>
        </div>
    </div>
    <!-- Bigg Boss End -->
