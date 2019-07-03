<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
$category_id = ((isset($_REQUEST['category']))?sanitize($_REQUEST['category']):'');
$price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
$min_price = ((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
$max_price = ((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
$brnd = ((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
$brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
?>
<h3 class="text-center"> Search Items By:</h3>
<h4 class="text-center">Price</h4>
<form action="search.php" method="post">
  <input type="hidden" name="category" value="<?=$category_id;?>">
  <input type="hidden" name="price_sort" value="0">
<input type="radio" name="price_sort" value="low"<?=(($price_sort =='low')?'checked':'');?>>Low to High<br>
<input type="radio" name="price_sort" value="high"<?=(($price_sort =='high')?'checked':'');?>>High to Low<br><br>
<input type="text" name="min_price" class="price-range" placeholder="Min R" value="<?=$min_price;?>">To
<input type="text" name="max_price" class="price-range" placeholder="Max R" value="<?=$max_price;?>"><br><br>

<h4 class="text-center">Your Favorate Brands</h4>
<input type="radio" name="brand" value=""<?=(($brnd =='')?'checked':'');?>>All Brands<br>
<?php while($brand = mysqli_fetch_assoc($brandQuery)): ?>
<input type="radio" name="brand" value="<?=$brand['id'];?>"<?=(($brnd ==$brand['id'])?' checked':'');?>><?=$brand['brand'];?><br>
<?php endwhile; ?>
<input type="submit" value="Search" class="btn btn-xs btn-primary" id="text">
</form>
