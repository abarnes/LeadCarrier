<script type="text/javascript">
$(document).ready(function(){
		$(".checkboxall").click(function(){
		  var checked_status = this.checked;
                    $("input[class=checkal]").each(function()
                    {
                     this.checked = true;
                    });
		 });
	       
});
</script>

<?php $cou = count($categories);
            if ($cou>8) {
                $height = '500px';
                $mar = '-400px';
                $hh = '622px';
            } elseif ($cou>12) {
                $height = '570px';
                $mar = '-470px';
                $hh = '692px';
            } else {
                $height = '478px';
                $mar = '-350px';
                $hh = '600px';
}?>

<div class="container">
	    <?php echo $this->Session->flash(); ?>
              <div class="span-24">
                  <a name="top"></a>
             <!-----------top bar---->
                      <div style="float:left;">
                          <img src="/img/logo.png" style="height:90px;position:relative;right:50px;"/>
                      </div>
                      
                      <div style="float:right;margin-right:30px;margin-top:36px;">
                          <a href="http://www.facebook.com/pages/My-Wedding-Connector/255185641182379" target="_blank"><img src="/img/fb.png" style='float:left;width:50px;margin-right:8px;'/></a>
                          <a href="http://twitter.com/mywedconnector" target="_blank"><img src="/img/twitter.png" style='float:left;width:50px;margin-right:8px;'/></a>
                          <img src="/img/phonenumber.png" style="width:230px;float:left;"/>
                      </div>
                  
                  <div class="top2" style="height:30px;">      
                  </div>
                  
              </div>
          </div>
      </div>        
    <!----end top bar---->

<div style="background-color:#E0EFF7;">
    <div class="container">
	    <?php echo $this->Session->flash(); ?> 
        <div class="span-24" style="height:<?php echo $hh; ?>">
            <img src="/img/selecttext.png" style="width:950px;margin-top:-30px;position:relative;z-index:20;"/>

            <img src="/img/select-box.png" style="width:900px;margin-left:25px;margin-top:-30px;position:relative;z-index:21;height:<?php echo $height; ?>;"/>
                    
            <?php echo $this->Form->create('Category', array('action' => 'select/'.$id)); ?>
        
            <div class="sel-form" style="margin-top:<?php echo $mar; ?>">
                
            <div style="float:left;">    
                <div class="sel-checkall">
                    <a class="checkboxall"><img src="/img/sel-checkbox.png" style="margin-top:4px;"/></a>
                    <a class="checkboxall"><img src="/img/sel-checkall.png" style="float:right;"/></a>
                    <br/>
                    <?php if ($cou<7) { ?>
                        <br/><br/>
                    <?php } ?>
                </div>
                
                <table>
                    <tr>
                        <?php
                        $cc = 2;
                        foreach ($categories as $c) {
                            if ($cc%2==0) {
                                echo '</tr><tr><td>';
                            } else {
                                echo '<td>';
                            }
                            
                            if ($c['Category']['use_ranges']=='0') {
                                echo $this->Form->checkbox('c'.$c['Category']['id'], array('label'=>'','class'=>'checkal','checked'=>true)).'<label> '.$c['Category']['name'].'</label><br/><br/>';
                            } else {
                                $arr = array();
                                foreach ($c['Range'] as $r) {
                                    $arr[$r['id']]=$r['name'];
                                }
                                echo $this->Form->checkbox('c'.$c['Category']['id'], array('label'=>'','class'=>'checkal','checked'=>true)).'<label> '.$c['Category']['name'].'</label><br/>';
                                echo $this->Form->input('v'.$c['Category']['id'], array( 'label' => '','options'=>$arr));
                            }
                            echo '</td>';
                            $cc++;
                        } ?>
                    </tr>
                </table>
            </div>
                
            <img src="/img/sel-pic.png" class="sel-img"/>
            
            </div>
            
            <div class="sel-submit">
                <input src="/img/sel-submit.png" type="image">
            </div>
        </div>
    </div>
    <br/><br/>
    
</div>