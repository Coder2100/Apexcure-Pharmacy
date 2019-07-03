<h3 class="text-center">Shopping Trolley</h3>
<div>
	<?php if(empty($trolley_id)):?>
     <p class="text-danger">Your shopping trolley is empty.</p>
	<?php else:
      $trolleyQ =$db->query("SELECT * FROM trolley WHERE id = '{$trolley_id}'");
      $results = mysqli_fetch_assoc($trolleyQ);
      $items = json_decode($results['items'],true);
      //$i =1;
			// where i = incrementer/iterator
      $sub_total = 0;
	?>
     <table class="table table-condensed" id = "trolley_widget">
     	<tbody>
     		<?php foreach ($items as $item):
                $productQuery = $db->query("SELECT * FROM products WHERE id = '{$item['id']}'");
                $product = mysqli_fetch_assoc($productQuery);
     		?>
     		<tr>
     			<td><?=$item['quantity'];?></td>
     			<td><?=substr($product['title'],0.15);?></td>
     			<td><?=money($item['quantity'] * $product['price']);?></td>
     		</tr>
     	<?php

         $sub_total += ($item['quantity'] * $product['price']);

     	endforeach; ?>
     	<tr>
     		<td></td>
     		<td>Sub Total</td>
     		<td><?=money($sub_total);?></td>
     	</tr>
     	</tbody>
     </table>
     <a href="trolley.php" class="btn btn-xs btn-primary pull-right">View Trolley</a>
     <div class="clearfix"></div>
	<?php endif; ?>

</div>
