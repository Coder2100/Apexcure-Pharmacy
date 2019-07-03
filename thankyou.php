<?php
 require_once 'core/init.php';
 require_once 'vendor/stripe/stripe-php/init.php';
 require_once 'vendor/autoload.php';
 //include 'helpers/helpers.php';

 // Set your secret key: remember to change this to your live secret key in production
 // See your keys here: https://dashboard.stripe.com/account/apikeys
 \Stripe\Stripe::setApiKey("STRIPE_PRIVATE");

 // Token is created using Checkout or Elements!
 // Get the payment token ID submitted by the form:
 $token = isset($_POST['stripeToken'])? $_POST['stripeToken'] : '';
 //Get the rest of the post data

 $full_name = isset($_POST['full_name'])? $_POST['full_name'] : '';
 $email = isset($_POST['email'])? $_POST['email'] : '';
 $street = isset($_POST['street'])? $_POST['street'] : '';
 $street2 = isset($_POST['street2'])? $_POST['street2'] : '';
 $city = isset($_POST['city'])? $_POST['city'] : '';
 $state = isset($_POST['state'])? $_POST['state'] : '';
 $zip_code = isset($_POST['zip_code'])? $_POST['zip_code'] : '';
 $country = isset($_POST['country'])? $_POST['country'] : '';
 $tax = isset($_POST['tax'])? $_POST['tax'] : '';
 $sub_total = isset($_POST['sub_total'])? $_POST['sub_total'] : '';
 $grand_total = isset($_POST['$grand_total'])? $_POST['grand_total'] : '';
 $trolley_id = isset($_POST['trolley_id'])? $_POST['trolley_id'] : '';
 $description = isset($_POST['description'])? $_POST['description'] : '';
 $charge_amount = number_format($grand_total, 1) *100;
 $metadata = array(
   "trolley_id"   => $trolley_id,
   "tax"          => $tax,
   "sub_total"    => $sub_total,
 );
 //create the charge on stripe servers - this will charge the user's Card
try{
 $charge = \Stripe\Charge::create(array(
     "amount"         => $charge_amount,// amount in cents, again
     "currency"       => CURRENCY,
     "description"    => $description,
     "source"         => $token,
     "receipt_email"  => $email,
     "metadata"       => $metadata)
);

//u djust inventory whenever there is a sale

$itemQuantity =$db->querry("SELECT FROM trolley WHERE id = '{trolley_id}'");
$itemresults = mysqli_fetch_assoc($itemQuantity);
$items = json_decode($itemresults['items'],true);
foreach($items as $item){
  $newSizes =array();
  $item_id =$item['id'];
  $productQuantity = $db->query("SELECT sizes FROM products WHERE id ='{'$item_id'}'");
  $product = mysqli_fetch($productQuantity);
  $sizes = sizesToArray($product['sizes']);
  foreach ($sizes as $size) {
    // code...
    if($size['item'] == $item['size']){
    $quantity =$size['inventory_quanty']- $item['inventory_quantity'];
    $newSizes[] = array('sizes' => $size['size'],'inventory_quantity' =>$inventory_quantity);
  }else{
    $newSizes[] = array('size' => $size['size'],'inventory_quantity' =>$size['inventory_quantity']);
       }
  }
  $sizeString = sizesToString($newSizes);
  $db->query("UPDATE products SET sizes = '{$sizeString}' WHERE id = '{$item_id}'");
}

// update trolley
$db->query("UPDATE trolley SET paid = 1 WHERE id = '{$trolley_id}'");
$db->query("INSERT INTO transactions
(charge_id,trolley_id,full_name,street,street2,city,state,zip_code,country,sub_total,tax,grand_total,description,txn_type) VALUES
('$charge->id','$trolley_id','$full_name','$email','$street','$street2','$city','$state','$zip_code','$country','$sub_total','$tax','$grand_total','$description','$charge->object')");

$domain = ($_SERVER['HTTP_HOST'] != 'localhost')? '.'.$_SERVER['HTTP_HOST']:false;
setcookie(TROLLEY_COOKIE,'',1,"/".$domain,false);
include 'includes/head.php';
include 'includes/navigation.php';
include 'includes/headerpartial.php';
?>
<h1 class="text-center text-success"> Thank You</h1>
<p>Your card has been successfully charged <?=money($grand_total);?>.You have been emailed a receipt.Please check your spam folder if it is not in your inbox.Additionally you can print this page as a receipt.</p>
<p>Your receipt number is:<strong><?=$trolley_id;?></strong></p>
<p>Your order will be shipped to the address below.</p>
<address>
	<?=$full_name;?><br>
	<?=$street;?><br>
	<?=(($street2 != '')?$street2.'<br>':'');?>
	<?=$city.','.$state.''.$zip_code;?><br>
	<?=$country;?><br>
</address>

<?php
include 'includes/footer.php';
}catch(\stripe\Error\Card $e) {
  //The Card has been declined
  echo $e;
}
?>
