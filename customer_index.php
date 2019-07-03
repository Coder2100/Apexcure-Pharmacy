<?php
require_once 'core/init.php';
include 'includes/head.php';
 
include 'includes/leftbar.php';
$first_name = ((isset($_POST['first_name']))?sanitize($_POST['first_name']):'');
$sql = "SELECT* FROM products WHERE featured =1";
$featured = $db->query($sql);
//if(!isset($_SESSION['first_name']) || empty($_SESSION['first_name'])){
  //header("location: custologin.php");
  //exit;
//}
?>
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"          ></span>Hello
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu">
      <li><a href="#admin_profile">Edit Profile</a></li>
      <li><a href="change_password.php">Change Password</a></li>
      <li><a href="logout.php">Log Out</a></li>
    </ul>
     </li>
  </div>
</nav>

  <!-- main content-->
    <div class="col-md-8">
    <div class="row">
      <h2 class="text-center">Best Featured Products</h2>
      <?php while($product = mysqli_fetch_assoc($featured)) : ?>
      <div class="col-md-3 text-center">
    <h4><?= $product['title']; ?></h4>
    <?php $photos = explode(',',$product['images']); ?>
    <img src="<?= $photos[0]; ?>" alt="<?= $product['title']; ?>" class="img-thumb"/>
    <p class="list_price text-danger">List price:<s>R<?= $product['list_price']; ?></s></p>
    <p class="price">Our Price: R<?= $product['price']; ?></p>
   <button type="button" class="btn btn-sm btn-success" onclick="detailsmodal(<?= $product['id']; ?>)">Details</button>
</div>
<?php endwhile; ?>

</div>
</div>
<?php
include 'includes/rightbar.php';
include 'includes/footer.php';
 ?>
