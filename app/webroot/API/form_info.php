<?php
/*--------------------------------------------------------------------------
 This file automatically renders a complete form, both client information and selections.
 
 To generate this form in your website, use the following code in your header:
 <script type="text/javascript">
    $(document).ready(function() {
      $.get('API/form_all.php', function(data) {
        $('#LeadCarrierForm').html(data);
      });
    });
</script>
 --------------------------------------------------------------------------*/

include('config.php');

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $leadcarrier_url."/get_fields");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);
$fields = json_decode($result);

/*$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $leadcarrier_url."/get_selections");
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
$result = curl_exec($ch);
curl_close($ch);
$categories = json_decode($result);*/

/*---------------------------Edit below this line to change the appearance of the industry select form----------------------------------*/
echo '<form action="'.$site_url.'/API/parse.php" method="post">';
foreach ($fields as $f) {
  switch ($f->Field->type) {
    case 'text':
      echo '<label class="'.$select_label_class.'">'.$f->Field->display_name.'</label><br/><textarea class="'.$input_textarea_class.'" name="I'.$f->Field->name.'"></textarea><br/>';
      break;
    case 'tinyint':
      echo '<label class="'.$select_label_class.'">'.$f->Field->display_name.' </label><input type="checkbox" name="I'.$f->Field->name.'"><br/>';
      break;
    default:
      echo '<label class="'.$select_label_class.'">'.$f->Field->display_name.'</label><input type="text" name="I'.$f->Field->name.'"><br/>';
      break;
  }
}
echo '<input type="submit" class="'.$submit_button_class.'" value="submit"/></form>';

/*--------------*/
exit();
?>  