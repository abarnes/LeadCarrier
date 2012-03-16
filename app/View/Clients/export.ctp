<?php 
$labels = array('first_name'=>'First Name','last_name'=>'Last Name','id'=>'ID');
foreach($data as $i => $register)  
{ 
    if ($i == 0)  
    { 
        $header = array(); 
        foreach($register['Client'] as $field => $value)  
        { 
            $header[] = $labels[$field]; 
        }
        //die(print_r($header));
        if (!$this->Excel->addRow($header)) {
            echo 'f';
        }
    } 
    $this->Excel->addRow($register); 
} 

$file = 'register-'.date('d-m-Y'); 
$this->Excel->render($file);
?> 