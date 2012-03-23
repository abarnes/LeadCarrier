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
            	<li><img src="image/icon/a1.png" alt="" class="leftcloumb-list-img"> <h1>Address:</h1><p>PO Box 703064<br/>Dallas, TX 75370-3064</p></li>
                <li><img src="image/icon/a2.png" alt="" class="leftcloumb-list-img"> <h1>Telephone:</h1><p>(555) 555-5555</p></li>
                <li><img src="image/icon/a3.png" alt="" class="leftcloumb-list-img"> <h1>E-Mail</h1><p><a href="mailto:info@leadcarrier.com">info@leadcarrier.com</a></p></li>
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
	    <?php echo $this->Form->create('Contact',array('action'=>'submit','inputDefaults' => array('label' => false,'div' => false))); ?>
	    <fieldset><?php echo $this->Form->input('name',array('value'=>'Name:','onfocus'=>"if(this.value=='Name:')this.value='';","onblur"=>"if(this.value=='')this.value='Name:';")); ?></fieldset>
	    <fieldset><?php echo $this->Form->input('email',array('value'=>'Email:','onfocus'=>"if(this.value=='Email:')this.value='';","onblur"=>"if(this.value=='')this.value='Email:';")); ?></fieldset>
	    <fieldset><?php echo $this->Form->input('company',array('value'=>'Company:','onfocus'=>"if(this.value=='Company:')this.value='';","onblur"=>"if(this.value=='')this.value='Company:';")); ?></fieldset>
            <fieldset><?php echo $this->Form->input('message',array('type'=>'textarea','value'=>'Message:','onfocus'=>"if(this.value=='Message:')this.value='';","onblur"=>"if(this.value=='')this.value='Message:';")); ?></fieldset> 
            <div class="fright"><fieldset><input type="submit" value="Send" /></fieldset></div>
	    </form>
        </div>
    </div>
    <!-- Bigg Boss End -->
