 <div class="grid_10 margin leftsays">
        <div class="title-2cloumb">
        	<h1>Sign Up</h1>
        </div>
        <div class="comment-form margin">
        <?php //die(print_r($errors)); ?>
	    <?php echo $this->Form->create('Company',array('action'=>'register/'.$selected,'inputDefaults' => array('label' => false,'div' => false))); ?>
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('name',array('onfocus'=>"if(this.value=='Company Name')this.value='';","onblur"=>"if(this.value=='')this.value='Company Name';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('name',array('value'=>'Company Name','onfocus'=>"if(this.value=='Company Name')this.value='';","onblur"=>"if(this.value=='')this.value='Company Name';")); ?></fieldset>
            <?php } ?>
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('address1',array('onfocus'=>"if(this.value=='Address Line 1')this.value='';","onblur"=>"if(this.value=='')this.value='Address Line 1';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('address1',array('value'=>'Address Line 1','onfocus'=>"if(this.value=='Address Line 1')this.value='';","onblur"=>"if(this.value=='')this.value='Address Line 1';")); ?></fieldset>
             <?php } ?>
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('address2',array('onfocus'=>"if(this.value=='Address Line 2')this.value='';","onblur"=>"if(this.value=='')this.value='Address Line 2';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('address2',array('value'=>'Address Line 2','onfocus'=>"if(this.value=='Address Line 2')this.value='';","onblur"=>"if(this.value=='')this.value='Address Line 2';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('city',array('onfocus'=>"if(this.value=='City')this.value='';","onblur"=>"if(this.value=='')this.value='City';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('city',array('value'=>'City','onfocus'=>"if(this.value=='City')this.value='';","onblur"=>"if(this.value=='')this.value='City';")); ?></fieldset>
             <?php } ?>
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('state',array('onfocus'=>"if(this.value=='State')this.value='';","onblur"=>"if(this.value=='')this.value='State';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('state',array('value'=>'State','onfocus'=>"if(this.value=='State')this.value='';","onblur"=>"if(this.value=='')this.value='State';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('zip',array('onfocus'=>"if(this.value=='Zip Code')this.value='';","onblur"=>"if(this.value=='')this.value='Zip Code';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('zip',array('value'=>'Zip Code','onfocus'=>"if(this.value=='Zip Code')this.value='';","onblur"=>"if(this.value=='')this.value='Zip Code';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('contact_name',array('onfocus'=>"if(this.value=='Contact Name')this.value='';","onblur"=>"if(this.value=='')this.value='Contact Name';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('contact_name',array('value'=>'Contact Name','onfocus'=>"if(this.value=='Contact Name')this.value='';","onblur"=>"if(this.value=='')this.value='Contact Name';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('phone',array('onfocus'=>"if(this.value=='Phone')this.value='';","onblur"=>"if(this.value=='')this.value='Phone';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('phone',array('value'=>'Phone','onfocus'=>"if(this.value=='Phone')this.value='';","onblur"=>"if(this.value=='')this.value='Phone';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
        	<fieldset><?php echo $this->Form->input('email',array('onfocus'=>"if(this.value=='Email')this.value='';","onblur"=>"if(this.value=='')this.value='Email';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('email',array('value'=>'Email','onfocus'=>"if(this.value=='Email')this.value='';","onblur"=>"if(this.value=='')this.value='Email';")); ?></fieldset>
             <?php } ?>
            
            <?php if (isset($errors)) { ?>
                <fieldset><?php echo $this->Form->input('subdomain',array('onfocus'=>"if(this.value=='Subdomain')this.value='';","onblur"=>"if(this.value=='')this.value='Subdomain';")); ?></fieldset>
            <?php } else { ?>
                <fieldset><?php echo $this->Form->input('subdomain',array('value'=>'Subdomain','onfocus'=>"if(this.value=='Subdomain')this.value='';","onblur"=>"if(this.value=='')this.value='Subdomain';")); ?></fieldset>
             <?php } ?>
             <?php echo $this->Form->checkbox('terms', array('hiddenField' => false,'error'=>true)); ?> I have read and agree to the <a href="/terms">Terms and Conditions</a><br/><br/>
            
            <div class="fleft"><fieldset><input type="submit" value="Register" /></fieldset></div>
	    </form>
        </div>
</div>
<!-- What Says Our Company End -->
    
<!-- Bigg Boss -->
<div class="grid_6 margin">
    	<div id="full-bottom2"></div>
        <div class="title-2cloumb">
        	<h1>Selected Plan: <?php echo ucfirst($selected); ?></h1><br/>
        </div>
        <div class="leftcloumb-list">
        	<ul>
            	<li><h1>Details:</h1><p>
                Full-featured account<br/>
                    <?php switch ($selected) {
                        case "monthly":
                            echo '$749.99 billed monthly<br/>';
                            break;
                        case "quarterly":
                            echo '$699.99 per month, billed quarterly ($2,099.97 per invoice)<br/>';
                            echo 'You save $600 a year!';
                            break;
                        default:
                            echo '$599.99 per month, billed annually ($7,199.88 per invoice<br/>';
                            echo 'You save $1,800 a year!';
                            break;
                    } ?>
                    <br/><br/>
                    You will receive your first invoice shortly after registering.  Failure to pay within 2 weeks of receipt will result in the deactivation of your account.
                </p></li>
                <li><h1>Subdomain</h1><p>Select a subdomain your company will use to access your Lead Carrier database.  For example, to access your database at http://example.leadcarrier.com, your subdomain would be "example".</p></li>
            </ul>
        </div>    
</div>


    