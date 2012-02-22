<?php
class RecordsController extends AppController {
 
	var $name = 'Records';
        //var $layout = 'default';
	var $helpers = array('Html', 'Form', 'Time');
	var $uses = array('Setting','Record','Category','Vendor','Client','Freshbooks.Item');
	public $components = array(
		'Session',
		'Auth' => array(
		    'loginRedirect' => array('controller' => 'companies', 'action' => 'index'),
		    'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
		)
	);
	
	function test () {
		die(print_r($this->Item->find('all')));
	}
        
        function beforeFilter() {
		parent::beforeFilter();
		
            //$this->Auth->allow('view');
	    
	    /*$connect = $this->connect();
	    if (!empty($connect)) {
		@App::import('ConnectionManager');
		$a = array(
			'datasource' => 'Database/Mysql',
			'persistent' => false,
			'host' => 'localhost',
			'login' => $connect['db_name'],
			'password' => $connect['db_password'],
			'database' => $connect['db_name'],
			'prefix' => '');
		try {
			ConnectionManager::create('new', $a);
		} catch (MissingDatabaseException $e) {
			$this->Session->setFlash('DB error: '.$e->getMessage());
		}
		$this->Record->setDataSource('new');
		$this->Vendor->setDataSource('new');
		$this->Category->setDataSource('new');
		$this->Setting->setDataSource('new');
		$this->Client->setDataSource('new');
	    }*/
        }
	
	public function dashboard(){
		$current_user = $this->Auth->user();
		if ($current_user['admin']=='1') {
			$this->redirect('/admin/companies');
		}
		
		$this->layout = 'admin';
		$this->set('down','dashboard');
		
		$ind = $this->Category->find('all',array('conditions'=>array('Category.enable'=>'1')));
		$s = $this->Setting->find('first',array('order'=>'Setting.created ASC'));
		
		if ($this->Record->find('count',array('conditions'=>array('Record.sent'=>'1')))!=0) {
			$this->set('go','1');
		
			if (empty($this->request->data)) {
				$this->set('brides',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >' => date('Y-m-d', strtotime("-1 month"))))));
				$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >' => date('Y-m-d', strtotime("-1 month")))));
				
				$f = 0;
				$total = 0;
				foreach ($ind as $i) {
					$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime("-1 month")))));
					$ind[$f]['leads'] = $l;
					$total = $total+$l;
					$f++;
				}
				
				$g = 0;
				foreach ($ind as $i) {
					$tt = $i['leads']/$total;
					$ind[$g]['perc'] = $tt*100;
					$g++;
				}
				$b = date('Y-m-d',strtotime("-1 month"));
				$beg = date('j',strtotime("-1 month"));
				$begin = strtotime($b);
				$end = strtotime(date('Y-m-d'));
				
				$this->set('nam','Previous month');
				$m = date('n',strtotime("-1 month"))-1;
				$this->set('starttime',date('Y',strtotime("-1 month")).', '.$m.', '.date('y',strtotime("-1 month")));
				$m = date('n')-1;
				$this->set('endtime',date('Y').', '.$m.', '.date('y'));
			} else {
				if ($this->request->data['Record']['start_date']==$this->request->data['Record']['end_date']) {
					$this->Session->setFlash('You cannot set the dates equal to each other.');
					$this->redirect(array('action'=>'dashboard'));
				}
				if ($this->request->data['Record']['start_date']!=null && $this->request->data['Record']['end_date']!=null) {
					$bo = strtotime($this->request->data['Record']['end_date']);
					$bo = $bo+86400;
					
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date'])),'Client.created <='=>date('Y-m-d', $bo)))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date'])),'Record.created <='=>date('Y-m-d', $bo))));
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date'])),'Record.created <='=>date('Y-m-d', $bo))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					$b = date('Y-m-d',strtotime($this->request->data['Record']['start_date']));
					$beg = date('j',strtotime($this->request->data['Record']['start_date']));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d',strtotime($this->request->data['Record']['end_date'])));
					
					$this->set('nam',date('M j, Y',strtotime($this->request->data['Record']['start_date'])).' to '.date('M j, Y',strtotime($this->request->data['Record']['end_date'])));
					$m = date('n',strtotime($this->request->data['Record']['start_date']))-1;
					$this->set('starttime',date('Y',strtotime($this->request->data['Record']['start_date'])).', '.$m.', '.date('j',strtotime($this->request->data['Record']['start_date'])));
					$m = date('n',strtotime($this->request->data['Record']['end_date']))-1;
					$this->set('endtime',date('Y',strtotime($this->request->data['Record']['end_date'])).', '.$m.', '.date('j',strtotime($this->request->data['Record']['end_date'])));
				} elseif ($this->request->data['Record']['start_date']==null && $this->request->data['Record']['end_date']!=null) {
					/*$this->Session->setFlash('Please provide a start date.');
					$this->redirect(array('action'=>'dashboard'));*/
					$bo = strtotime($this->request->data['Record']['end_date']);
					$bo = $bo+86400;
					
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created <='=>date('Y-m-d', $bo)))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created <='=>date('Y-m-d', $bo))));
					
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created <='=>date('Y-m-d', $bo))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					
					$b = date('Y-m-d',strtotime("-3 months"));
					$beg = date('j',strtotime("-3 months"));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d',strtotime($this->request->data['Record']['end_date'])));
					
					$this->set('nam','Three months ago to '.date('M j, Y',strtotime($this->request->data['Record']['end_date'])));
					$m = date('n',strtotime("-3 months"))-1;
					$this->set('starttime',date('Y',strtotime("-3 months")).', '.$m.', '.date('j',strtotime("-3 months")));
					$m = date('n',strtotime($this->request->data['Record']['end_date']))-1;
					$this->set('endtime',date('Y',strtotime($this->request->data['Record']['end_date'])).', '.$m.', '.date('j',strtotime($this->request->data['Record']['end_date'])));
				} else {
					$this->set('brides',$this->Record->Client->find('count',array('conditions'=>array('Client.approved'=>'1','Client.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date']))))));
					$ld = $this->Record->find('all',array('conditions'=>array('Record.sent'=>'1','Record.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date'])))));
					
					$f = 0;
					$total = 0;
					foreach ($ind as $i) {
						$l = $this->Record->find('count',array('conditions'=>array('Record.sent'=>'1','Record.category_id'=>$i['Category']['id'],'Record.created >=' => date('Y-m-d', strtotime($this->request->data['Record']['start_date'])))));
						$ind[$f]['leads'] = $l;
						$total = $total+$l;
						$f++;
					}
					
					$g = 0;
					foreach ($ind as $i) {
						if ($total!=0) {
							$tt = $i['leads']/$total;
							$ind[$g]['perc'] = $tt*100;
						} else {
							$ind[$g]['perc'] = '0';	
						}
						$g++;
					}
					$b = date('Y-m-d',strtotime($this->request->data['Record']['start_date']));
					$beg = date('j',strtotime($this->request->data['Record']['start_date']));
					$begin = strtotime($b);
					$end = strtotime(date('Y-m-d'));
					
					$this->set('nam','From '.date('M j, Y',strtotime($this->request->data['Record']['start_date'])));
					$m = date('n',strtotime($this->request->data['Record']['start_date']))-1;
					$this->set('starttime',date('Y',strtotime($this->request->data['Record']['start_date'])).', '.$m.', '.date('j',strtotime($this->request->data['Record']['start_date'])));
					$m = date('n',strtotime(date('Y-m-d')))-1;
					$this->set('endtime',date('Y',strtotime(date('Y-m-d'))).', '.$m.', '.date('j',strtotime(date('Y-m-d'))));
				}
			}
			$this->set('rev',$total*$s['Setting']['lead_price']);
			$this->set('ind',$ind);
			$this->set('leads',count($ld));
			
			$dat = array();
				foreach ($ld as $l) {
					$f = date('Y-m-d',strtotime($l['Record']['created']));
					$f = strtotime($f);
					//die(print($f));
					//$d = strtotime($l['Record']['created']);
					if (array_key_exists($f,$dat)) {
						$dat[$f]['leads'] = $dat[$f]['leads']+1;
					} else {
						$dat[$f]['leads'] = 1;
						$dat[$f]['date'] = $f;
						$dat[$f]['stamp'] = $f;
					}
				}
				
				while ($begin<=$end) {
					if (!array_key_exists($begin,$dat)) {
						$dat[$begin]['leads'] = 0;
						$dat[$begin]['date'] = $begin;
						$dat[$begin]['stamp'] = $begin;
					}
					$begin = $begin+86400;
				} 
				
				$sortArray = array(); 
				
				$max = 50;
				foreach($dat as $person){
				    if ($person['leads']>$max) {
					$max = $person['leads'];
				    }
				    foreach($person as $key=>$value){				
					if(!isset($sortArray[$key])){ 
					    $sortArray[$key] = array(); 
					} 
					$sortArray[$key][] = $value; 
				    } 
				}
				$this->set('max',ceil($max / 10) * 10);
				
				$orderby = "stamp"; //change this to whatever key you want from the array
				array_multisort($sortArray[$orderby],SORT_ASC,$dat);
				
			$this->set('dat',$dat);
			
			$this->set('pendings',$this->Client->find('count',array('conditions'=>array('Client.approved'=>'0'))));
		} else {
			$this->set('go','0');
		}
		$this->set('active_vendors',$this->Vendor->find('count',array('conditions'=>array('Vendor.active'=>'1'))));
	}
	
	/*
	function add() {
		//$this->set('rs', $this->Range->Vendor->find('list'));
		if (!empty($this->request->data)) {
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash('Record Successfully Added.');
				$this->redirect(array('controller'=>'records','action' => 'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save Record');
			}
		}
	}
    
	function edit($id) {
		$this->set('id',$id);
		//$this->set('vendors', $this->Range->Vendor->find('list',array('order'=>'Range.name ASC')));
		if (empty($this->request->data)) {
			$this->request->data = $this->Record->read();
		} else {
			if ($this->Record->save($this->request->data)) {
				$this->Session->setFlash('Record Has Been Updated.');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash('Error: Failed to Save');
			} 
		}
	}
    
	function delete($id) {
		$this->Record->delete($id);
		$this->Session->setFlash('Record Successfully Deleted.');
		$this->redirect(array('action'=>'index'));
	}*/
	
}

?>