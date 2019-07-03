<?php
$db = mysqli_connect('localhost','apexcure','password','eight');
$sql = "SELECT * FROM categories WHERE parent = 0";
$pquery = $db->query($sql);
?>

<nav class="navbar navbar-default navbar-fixed-top" id="navbar">
  <div class="container-fluid">
    <div class="navbar-header">
    <b><a href="/eight/index.php" class="navbar-brand" id="text"> Apexcure Pharmacy</a></b></div>
    <ul class="nav navbar-nav" id="text">
    <?php while($parent = mysqli_fetch_assoc($pquery)) : ?>
      <?php $parent_id = $parent['id'];
      $sql2 = "SELECT * FROM categories WHERE parent = '$parent_id'";
      $cquery = $db->query($sql2);
       ?>
<!--- Menu items -->
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><?php echo $parent['category'];?><span class="caret"></span></a>
      <ul class="dropdown-menu" role="menu" id="text">
      <?php while($child = mysqli_fetch_assoc($cquery)) : ?>
      <li><a href="category.php?cat=<?=$child['id'];?>"><?php echo $child['category']; ?></a></li>

    <?php endwhile; ?>
      </ul>
    </li>
  <?php endwhile; ?>

  <li style="width:500px;left:-200px;top:-36px;"><input type="text" class="form-control" id="search"></li>
  <li style="top:-36px;left:-200px;"><button class="btn btn-primary" id="search_btn"><span class="glyphicon glyphicon-search"></span></button></li>

  <ul class="nav navbar-nav navbar-right" id="text">
    <li><a href="trolley.php" id="text"><span class="glyphicon glyphicon-shopping-cart" id="text"></span> My Trolley</a></li>
   <li><a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span class="glyphicon glyphicon-user" id="text">Welcome!</a></span>
          <ul class="dropdown-menu" id="text">
            <li><a href="customer_register.php">Register</a></li>
            <li ><a href="customer_login.php">Login</a></li>
          </ul>
        </li>
    </ul>
    </ul>
 </div>
</nav>
