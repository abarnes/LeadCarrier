<?php
include('config.php');

$vars = $_POST;
foreach ($vars as $row=>$value) {
  $post[$row] = $value;  
}

if ($submit_type=='separate'&&isset($post['id'])) {
  $parse_url = 'parse_selections';
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $leadcarrier_url."/".$parse_url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);

if ($result=='done') {
  header('Location: '.$redirect_url);
} else {
  header('Location: '.$selection_url.'?id='.$result);
}
exit();
?>  