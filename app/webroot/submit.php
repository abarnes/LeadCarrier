<?php
$post = array(
    'api_token' => 'apitoken',
    'company_name'=>'Barnespos'
);
/*Do not edit below this line-------------------------------------*/
$vars = $_POST;
foreach ($vars as $row=>$value) {
  $post[$row] = $value;  
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "localhost:8888/apis/parse_info");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>  