<?php
require_once '../core/init.php';
if(!is_logged_in()){
	header('Location: login.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

 ?>
<!--Orders to fill-->
<?php
   $txnQuery= "SELECT t.id, t.trolley_id, t.full_name,t.description, t.txn_date, t.grand_total, tr.items, tr.paid, tr.delivered
   FROM transactions t
   LEFT JOIN trolley tr ON t.trolley_id = tr.id
   WHERE tr.paid = 1 AND tr.delivered = 0
   ORDER BY t.txn_date";
   $txnResults = $db->query($txnQuery);
 ?>
<div class="colmd-12">
	<h3 class="text-center"> Orders To Deliver</h3>
	<table class="table table-condensed table-bordered table-striped">
		<thead>
			<th></th><th>Name</th><th>Description</th><th>Total</th><th>Date</th>
		</thead>
		<tbody>
			<?php while($order = mysqli_fetch_assoc($txnResults)): ?>
			<tr>
			<td><a href="orders.php?txn_id=<?=$order['id'];?>" class="btn btn-xs btn-info">Details</a></td>
			<td><?=$order['full_name'];?></td>
			<td><?=$order['description'];?></td>
			<td><?=money($order['grand_total']);?></td>
			<td><?=pretty_date($order['txn_date']);?></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>
 <div class="row">
     <!--Sales By Month-->
	 <?php
	     $thisYr = date("Y");
		 $lastYr = $thisYr -1;
		 $thisYrQ = $db->query("SELECT grand_total, txn_date FROM transactions WHERE YEAR(txn_date) = '{$thisYr}'");
	     $lastYrQ = $db->query("SELECT grand_total, txn_date FROM transactions WHERE YEAR(txn_date) = '{$lastYr}'");
	     $current = array();
		 $last = array();
		 $currentTotal= 0;
		 $lastTotal = 0;
		 // current year
		 while($x= mysqli_fetch_assoc($thisYrQ)){
			 $month = date("m",strtotime($x['txn_date']));
			 if(!array_key_exists($month,$current)){
				 $current[(int)$month] = $x['grand_total'];
			 }else{
				 $current[(int)$month] += $x['grand_total'];
			 }
			 $currentTotal +=$x['grand_total'];
		 }
		 //prior year
		  while($y= mysqli_fetch_assoc($lastYrQ)){
			 $month = date("m", strtotime($y['txn_date']));
			 if(!array_key_exists($month,$last)){
				 $last[(int)$month] = $y['grand_total'];
			 }else{
				 $last[(int)$month] +=$y['grand_total'];
			 }
			 $lastTotal +=$y['grand_total'];
		 }
	 ?>
     <div class="col-md-4">
	    <h3 class="text-center">Monthly Sales Report</h3>
		<table class="table table-condensed table-striped table-bordered">
		<thead>
		  <th></th>
		  <th><?=$lastYr;?></th>
		  <th><?=$thisYr;?></th>
		  <tbody>
		  <?php for($i = 1;$i <= 12;$i++):
		    $dt = DateTime::createFromFormat('!m',$i);

		  ?>
		    <tr<?=(date("m") == $i)?' class="info"':'';?>>
			<td><?=$dt->format("F");?></td>
			<td><?=(array_key_exists($i,$last))?money($last[$i]):money(0);?></td>
			<td><?=(array_key_exists($i,$current))?money($current[$i]):money(0);?></td>
			</tr>
			<?php endfor;?>
			<tr>
			<td>Total</td>
			<td><?=money($lastTotal);?></td>
			<td><?=money($currentTotal);?></td>
			</tr>
		  </tbody>
		</thead>
	   </table>
	</div>
	 <!-- Inventory-->
	 <?php
	 $inventoryQuery = $db->query("SELECT * FROM products WHERE deleted = 0");
	 $lowItems = array();
	 while($product = mysqli_fetch_assoc($inventoryQuery)){
	 	$item = array();
	 	$sizes = sizesToArray($product['sizes']);
	 	foreach ($sizes as $size){
	 		if($size['quantity'] <=$size['threshold']){
	 	  $cat = get_category($product['categories']);
	 	  $item = array(
	 	  	'title' => $product['title'],
	 	  	'size' =>$size['size'],
	 	  	'quantity' =>$size['quantity'],
	 	  	'threshold' =>$size['threshold'],
	 	  	'category' => $cat['parent'].' ~'.$cat['child']
	 	  );
	 	  $lowItems[] = $item;
	 	  }
	 	}
	 }
	 ?>
	<div class="col-md-8">
	    <h3 class="text-center">Low Stock Items</h3>
	    <table class="table table-condensed table-striped table-bordered">
		<thead>
		     <th>Product</th>
			 <th>Category</th>
			 <th>Size</th>
			 <th>Quantity</th>
			 <th>Threshold</th>
			 </thead>
			 <tbody>
			<?php foreach($lowItems as $item):?>
			     <tr <?=($item['quantity'] == 0)?'class="danger"':'' ;?>>
				    <td><?=$item['title']; ?></td>
					<td><?=$item['category']; ?></td>
					<td><?=$item['size']; ?></td>
					<td><?=$item['quantity']; ?></td>
					<td><?=$item['threshold']; ?></td>
				 </tr>
				 <?php endforeach; ?>
			 </tbody>
		</table>
	 </div>
   </div>
<?php include 'includes/footer.php'; ?>
