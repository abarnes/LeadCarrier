<a name="top"></a>
<div class="container">
              <div class="span-24">
                  <a name="top"></a>
             <!-----------top bar---->
                      <div style="float:left;">
                          <img src="/img/logo.png" style="height:90px;position:relative;right:50px;"/>
                      </div>
                      
                      <div style="float:right;margin-right:30px;margin-top:36px;">
                          <a href="/"><img src="/img/vd-homebutton.png" style="margin-top:-15px;"/></a>
                      </div>
                  
                  <div class="top2" style="height:30px;">      
                  </div>
                  
              </div>
          </div>
      </div>        
<!----end top bar---->
      
      
<div style="width:100%;background-color:#E0EFF7;">
    <div class="container">
    
        <div class="span-11" style="height:500px;">
            <img src="/img/vd-qualified.png" style="width:400px;margin-left:10px;"/>
            <table style="margin-left:45px;margin-bottom:0px;margin-top:-40px;">
                <tr>
                    <td class="np">
                        <img src="/img/flourish.png"/>
                    </td>
                    <td>
                        <p><span class="bullets">Managed Advertising Solution</span></p>
                    </td>
                </tr>
                <tr>
                    <td class="np">
                        <img src="/img/flourish.png"/>
                    </td>
                    <td>
                        <p><span class="bullets">Grow Your Business Quickly</span></p>
                    </td>
                </tr>
                <tr>
                    <td class="np">
                        <img src="/img/flourish.png"/>
                    </td>
                    <td>
                        <p><span class="bullets">Spend Less, Make More</span></p>
                    </td>
                </tr>
                <tr>
                    <td class="np">
                        <img src="/img/flourish.png"/>
                    </td>
                    <td>
                        <p><span class="bullets">Focus on Your Passion</span></p>
                    </td>
                </tr>
            </table>
            <img src="/img/vd-applytoday.png" style="position:relative;z-index:1;margin-top:-10px;margin-left:0px;width:400px;"/>
            <!--<div style="height:200px;overflow:hidden;position:relative;bottom:70px;left:30px;">
                <img src="/img/texas.png"/>
            </div>-->
        </div>
        
        <div class="span-13 last" style="height:480px;">
            <img src="/img/vd-formback.png" style="position:relative;left:-33px;z-index:5;margin-top:40px;"/>
            <div class="vfrm">
                <h6 style="color:red;"><?php echo $this->Session->flash(); ?></h6>
                <?php echo $this->Form->create('Vendor', array('action' => 'vadd')); ?>
                <?php echo $this->Form->input('first_name', array( 'placeholder' => 'FIRST NAME','label'=>'')); ?>
                <?php echo $this->Form->input('last_name', array( 'placeholder' => 'LAST NAME','label'=>'')); ?>
                <?php echo $this->Form->input('email', array( 'placeholder' => 'EMAIL','label'=>'')); ?>
                <?php echo $this->Form->input('phone', array( 'placeholder' => 'TELEPHONE','label'=>'')); ?>
                <?php echo $this->Form->input('industry', array( 'placeholder' => 'INDUSTRY','label'=>'')); ?>
		<?php echo $this->Form->checkbox('agree', array('label'=>'','style'=>'width:20px;')); ?>I agree to the <a class="oterms">Terms of Use</a>
                <br/><br/>
                <div style="width:240px;text-align:center;">
                    <input src="/img/submit.png" type="image" style="width:200px;">
                </div>
                <?php //echo $this->Form->end('Submit'); ?>
            </div>
        </div>
    </div>
</div>
    
    <!------second section begins------>
<div class="top" style="height:30px;width:100%;">      
</div>

<div style="background-color:#E0EFF7;width:100%;">
    <div class="vmidback">
        <div class="container">
            
            <div class="span-10 vbottom">
                <h1>BENEFITS TO YOU</h1>
                <p>Don't pay to be another name listed in a directory, allow us to send you hand selected leads.
                    <br/><br/>
                My Wedding Connector allows you to focus on closing the sale, instead of wasting time hunting down new customers.  We grow an active community of brides-to-be through a portfolio of advertising campaigns across multiple platforms. We handle all the leg work so you don't have to.
                    <br/><br/>
                No scraping existing lists or sending you old leads, all of our brides are reviewed and approved by our staff before they are sent to you.
                    <br/><br/>
                On average our Vendors closes 30% of their leads enabling them to rapidly expand their business and avoid the hassle of managing time consuming advertising campaigns.
                </p>
                
                <div style="text-align:center;">
                    <img src="/img/vd-bottompic.png" style="width:380px;"/>
                    <a href="#top"><img src="/img/vd-applytoday-bottom.png" style="width:280px;margin-right:auto;margin-left:auto;"/></a>
                    <h2>REFER A FRIEND</h2>
                </div>
            </div>
            
            <div class="span-14 last">
                <img src="/img/vd-bottomback.png" style="width:550px;"/>
                <img src="/img/vd-how.png" style="position:relative;bottom:834px;width:520px;margin-left:15px;position:relative;z-index:60;"/>
                
		<div style="margin-top:-820px;">
                    <table class="vbottomtable">
                        <tr>
                            <td style="width:80px;">
                                <h4>STEP 1</h4>
                            </td>
                            <td>
                                <p>Brides fill out our simple survey to tell us what they are looking for.
                            </td>
                        </tr>
                        <tr>
                            <td style="width:80px;">
                                <h4>STEP 2</h4>
                            </td>
                            <td>
                                <p>We screen each lead to ensure validity.<br/><br/></p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 style="width:80px;">STEP 3</h4>
                            </td>
                            <td>
                                <p>We send you the contact information of every bride interested in your service.</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
			      <br/>
                                <h4 style="width:80px;">STEP 4</h4>
                            </td>
                            <td>
                                <p>You contact the bride knowing precisely what she is looking for.</p>
                            </td>
                        </tr>
                    </table>
                    <div class="vbot">
                        <p>With our customized, pay-per-lead plan you choose how many leads you want and only pay for the leads we generate. My Wedding Connector charges <b>$5 per lead</b> and offer a reliable method for growing your business.</p>
                        
                        <img src="/img/logo.png" style="height:90px;margin-left:45px;"/>
                        <h2>WHAT OUR CLIENTS ARE SAYING</h2>
                        <table class="vquotes">
                            <tr>
                                <td>
                                    <p>"I was skeptical about the whole lead generation concept but <b>My Wedding Connector</b> really surprised me. The money I spend on leads is nothing compared to how much new business I am getting.  My schedule is full!"<br/>
                                        <span class="vquoter">Meredith G, Hairstylist</span></p>
                                </td>
                                <td>
                                    <p><b>MyWeddingConnector.com</b> really focuses on quality and every bride they have sent me has been a quality lead.  They have helped us steadily grow our business and we convert a majority of the brides we get!<br/>
                                        <span class="vquoter">Thomas G, Photographer</span></p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <p><b>MyWeddingConnector.com</b> has helped turn my business around.  Times may be hard, but they helped me connect with so many brides that business is booming!  Great Service!  I highly recommend <b>MyWeddingConnector.</b><br/>
                                        <span class="vquoter">John C, Videographer</span></p>
                                </td>
                                <td>
                                    <p>I started out looking at online directories  but nothing was working.  I signed up and within a couple days I was contacted by 3 vendors who all offered me the best deals I'd seen yet.  I couldn't believe how well this free service worked.<br/>
                                        <span class="vquoter">Stephanie, Bride</span></p>
                                </td>
                            </tr>
                        </table>
                    </div>
		</div>

            </div>
    </div>
</div>