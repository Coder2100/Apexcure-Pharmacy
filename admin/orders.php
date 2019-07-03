<?php
require_once '../core/init.php';
if(!is_logged_in()){
	header('Location login.php');
   }
   include 'includes/head.php';
   include 'includes/navigation.php';

   // complete orders
   if(isset($_GET['complete']) && $_GET['complete'] == 1){
	   $trolley_id = sanitize((int)$_GET['trolley_id']);
	   $db->query("UPDATE trolley SET delivered = 1 WHERE id = '{$trolley_id}'");
	   $_SESSION['success_flash'] = "The The Order Has Been Completed!";
	   header('Location: index.php');
   }

   //$txn_id = sanitize((int)$_GET['txn_id']);
	 $txn_id = isset($_GET['txn_id']) ? $_GET['txn_id'] : '';
   $txnQuery = $db->query("SELECT * FROM transactions WHERE id = '{$txn_id}'");
   $txn = mysqli_fetch_assoc($txnQuery);
   $trolley_id = $txn['trolley_id'];
   $trolleyQuery = $db->query("SELECT * FROM trolley WHERE id = '{$trolley_id}'");
   $trolley = mysqli_fetch_assoc($trolleyQuery);
   $items = json_decode($trolley['items'],true);
   $idArray = array();
   $products = array();
   foreach($items as $item){
	   $idArray[] = $item['id'];
   }
   $ids = implode(',',$idArray);
   $productQuery = $db->query(
   "SELECT i.id as 'id',i.title as 'title', c.id as 'cid', c.category as 'child', p.category as 'parent'
   FROM products i
   LEFT JOIN categories c ON i.categories = c.id
	 LEFT JOIN categories p ON c.parent = p.id
   WHERE i.id IN ({$ids})");
// i for items.p for parent,c for categories
   while($p = mysqli_fetch_assoc($productQuery)){

	   foreach($items as $item){
	   if($item['id'] == $p['id']){
		 $x = $item;
		 continue;
	   }

	   }
	   $products[] = array_merge($x,$p);var_dump($products);
   }
?>
<h2 class="text-center">Items Ordered</h2>
<table class="table table-condensed table-bordered table-striped">
 <thead>
 <th>Quantity</th>
 <th>Title</th>
 <th>Category</th>
 <th>Size</th>
 </thead>
 <tbody>
 <?php foreach($products as $product):?>
   <tr>
     <td><?=$product['quantity'];?></td>
	 <td><?=$product['title'];?></td>
	 <td><?=$product['parent'].'~'.$product['child'];?></td>
	 <td><?=$product['size'];?></td>
   </tr>
   <?php endforeach;?>
 </tbody>
 </table>
 <div class="row">
    <div class="col-md-6">
	 <h3 class="text-center"> Order Details</h3>
	 <table class= "table table-condensed table-striped table-bordered">
	     <tbody>
		    <tr>
			<td>Sub Total</td>
			<td><?=money($txn['sub_total']);?></td>
			</tr>
			<tr>
			<td>Tax</td>
			<td><?=money($txn['tax']);?></td>
			</tr>
			<tr>
			<td>Grand Total</td>
			<td><?=money($txn['grand_total']);?></td>
			</tr>
			<tr>
			<td>Order Date</td>
			<td><?=pretty_date($txn['txn_date']);?></td>
			</tr>
		  </tbody>
	 </table>
	</div>
	<div class="col-md-6">
	 <h3 class="text-center">Delivery Address</h3>
	 <address>
	     <?=$txn['full_name'];?><br>
		 <?=$txn['street'];?><br>
		 <?=($txn['street2'] !='')?$txn['street2'].'<br>':'';?>
		 <?=$txn['city'].', '.$txn['state'].' '.$txn['zip_code'];?><br>
		 <?=$txn['country'];?><br>
	 </address>
	</div>
  </div>
  <div class="pull-right">
    <a href="index.php" class="btn btn-large btn-default">Cancel</a>
	<a href="orders.php?complete=1&trolley_id=<?=$trolley_id;?>" class="btn btn-primary btn-large">Complete Order</a>
  </div>
  <?php include 'includes/footer.php';?>
