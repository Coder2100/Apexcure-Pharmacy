<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';

$product_id = sanitize($_POST['product_id']);
$size = sanitize($_POST['size']);
$available = sanitize($_POST['available']);
$quantity = sanitize($_POST['quantity']);
$items = array();
$items[] = array(
    'id'       => $product_id,
    'size'     => $size,
    'quantity' => $quantity,
);

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')?'.'.$_SERVER['HTTP_HOST']:false;
$query = $db->query("select * from products where id='{$product_id}'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash'] = $product['title']. ' Added to your product into trolley';

//check if the cart cookire exist
if ($trolley_id != ''){
    $trolleyQ = $db->query("select * from trolley where id='{$trolley_id}'");
    $trolley = mysqli_fetch_assoc($trolleyQ);
    $previous_items = json_decode($trolley['items'], true);
    $items_match = 0;
    $new_items = array();
    foreach ($previous_items as $pitems){
        if ($items[0]['id'] == $pitems['id'] && $items[0]['size'] == $pitems['size']){
            $pitems['quantity'] = $pitems['quantity'] + $items[0]['quantity'];
            if ($pitems['quantity'] > $available){
                $pitems['quantity'] = $available;
            }
            $items_match = 1;

        }
        $new_items[] = $pitems;
    }
    if ($items_match != 1){
        $new_items = array_merge($items,$previous_items);
    }
    $items_json = json_encode($new_items);
    $trolley_expire = date("Y-m-d H:i:s",  strtotime("+30 days"));
    $db->query("update trolley set items='{$items_json}', expire_date='{$trolley_expire}' where id='{$trolley_id}'");
    setcookie(TROLLEY_COOKIE,'',1,"/",$domain,false);
    setcookie(TROLLEY_COOKIE,$trolley_id,TROLLEY_COOKIE_EXPIRE,'/',$domain,false);
}  else {
     //add the cart to database and set cookie
    $items_json = json_encode($items);
    $trolley_expire = date("Y-m-d H:i:s",  strtotime("+30 days"));
    $db->query("insert into trolley(items,expire_date) values('{$items_json}','{$trolley_expire}')");
    $trolley_id = $db->insert_id;
    setcookie(TROLLEY_COOKIE,$trolley_id,TROLLEY_COOKIE_EXPIRE,'/',$domain,false);
}
?>
