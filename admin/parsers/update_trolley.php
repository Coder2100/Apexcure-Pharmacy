<?php
   require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
 $mode = isset($_POST['mode']) ? $_POST['mode'] : '';
 $edit_size = isset($_POST['edit_size']) ? $_POST['edit_size'] : '';
 $edit_id = isset($_POST['edit_id']) ? $_POST['edit_id'] : '';
 $trolleyQ = $db->query("SELECT * FROM trolley WHERE id = '{$trolley_id}'");
 $result = mysqli_fetch_assoc($trolleyQ);
 $items = json_decode($result['items'],true);
 $updated_items = array();
 $domain = (($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false);

 if($mode == 'removeone'){
  foreach($items as $item){
   if($item['id'] == $edit_id && $item['size'] == $edit_size){
    $item['quantity'] = $item['quantity'] - 1;
   }
   if($item['quantity'] > 0){
    $updated_items[] = $item;
   }
  }
 }

 if($mode == 'addone'){
  foreach($items as $item){
   if($item['id'] == $edit_id && $item['size'] == $edit_size){
    $item['quantity'] = $item['quantity'] + 1;
   }
    $updated_items[] = $item;
  }
 }

 if(!empty($updated_items)){
  $json_updated = json_encode($updated_items);
  $db->query("UPDATE trolley SET items = '{$json_updated}' WHERE id = '{$trolley_id}'");
  $_SESSION['success_flash'] = 'Your shopping trolley has been updated!';
 }

 if(empty($updated_items)){
  $db->query("DELETE FROM trolley WHERE id = '{$trolley_id}'");
  setcookie(TROLLEY_COOKIE,'',1,"/",$domain,false);
 }

 ?>
