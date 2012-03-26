<?PHP

  function cleanData(&$str)
  {
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
	if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
  }

  $flag = false;
  foreach($rows as $r) {
    if(!$flag) {
      # display field/column names as first row
      echo implode("\t", array_keys($r['Client'])) . "\r\n";
      $flag = true;
    }
    array_walk($r['Client'], 'cleanData');
    echo implode("\t", array_values($r['Client'])) . "\r\n";
  }
?>