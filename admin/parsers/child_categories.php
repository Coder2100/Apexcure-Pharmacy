<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
$parentID = isset($_POST['parentID']) ? $_POST['parentID'] : '';
$parentID = (int)$parentID;
$selected= isset($_POST['selected']) ? $_POST['selected'] : '';
$childQuery = $db->query("SELECT * FROM categories WHERE parent = '$parentID' ORDER BY category");
ob_start(); ?>
<option value=""></option>
<?php while($child = mysqli_fetch_assoc($childQuery)): ?>
	<option value="<?=$child['id'];?>"<?=(($selected == $child['id'])?' selected':'');?>><?=$child['category'];?></option>
	<?php endwhile; ?>
<?php echo ob_get_clean();?>