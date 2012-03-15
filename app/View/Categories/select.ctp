
            <?php echo $this->Form->create('Category', array('action' => 'select/'.$id)); ?>
	    
                        <?php
                        foreach ($categories as $c) {
                            
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
                        } ?>
                    
                
            
            <div class="sel-submit">
                <input value="submit" type="submit">
            </div>
        