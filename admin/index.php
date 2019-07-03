<?php
require_once '../core/init.php';
if(!is_logged_in()){
	login_error_redirect();
}

include 'includes/head.php';
include 'includes/navigation.php';

 ?>
<!--Orders to fill-->

<?php
$txnQuery = "SELECT t.id, t.trolley_id, t.full_name, t.description, t.txn_date,t.grand_total, c.items, c.paid, c.delivered
FROM transactions t
LEFT JOIN trolley c ON t.trolley_id = c.id
WHERE c.paid = 1 AND c.delivered = 0
ORDER BY t.txn_date";
$txnResults = $db->query($txnQuery);
?>
<div class="col-md-12">
	<h3 class="text-center">Orders To Ship<h3>
		<table class="table table-condensed table-bordered table-striped">
       <thead>
				 <th></th><th>Name</th><th>Description</th><th>Total</th><th>Date</th>
			 </thead>
			    <tbody>
						<?php while($order = mysqli_fetch_assoc($txnResults)):?>
						<tr>
							<td><a href="orders.php? txn_id=<?=$order['id'];?>" class="btn btn-xs btn-info">Details</a></td>
							<td><?=$order['full_name'];?></td>
							<td><?=$order['description'];?></td>
							<td><?money($order['grand_total']);?></td>
							<td><?=pretty_date($order['txn_date']);?></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
	     	</table>
		</div>

		<div class="row">
			<!-- sales by month--->
        <div class="col-md-4">

				</div>
		</div>




<?php include 'includes/footer.php'; ?>
