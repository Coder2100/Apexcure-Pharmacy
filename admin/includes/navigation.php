<?php

//function permission_error_redirect($url = 'login.php'){
//	$_SESSION['error_flash'] = 'You do not have permission to access that page';
	//header('Location:'.$url);
//}

//function has_permission($permission = 'admin'){
//	global $user_data;
	//$permissions = explode(' ,', $user_data['permissions']);
	//if(in_array($permission,$permissions,true)){
	//return true;
     //}
//	 return false;
//}
?>
<nav class="navbar navbar-default navbar-fixed-top" id="text">
  <div class="container">
    <a href="/eight/admin/index.php" class="navbar-brand" id="text"> Apexcure Admin</a>
    <ul class="nav navbar-nav">

        <!--Menu items-->
    <li><a href="index.php" id="text">My dashboard</a></li>
     <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span id="text" class="glyphicon glyphicon-shopping-cart"></span> Shopping!
    <span class="caret"></span></a>
    <ul class="dropdown-menu" role="menu" id="text">
     <li><a href="eight/index.php">Pharma Store</a></li>
      <li><a href="#brands.php">Fresh/Health Equip</a></li>
      <li><a href="#categories.php">Find Practitioner</a></li>
    </ul>
     </li>
     <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span id="text"></span>Human Resource
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu" id="text">
     <li><a href="users.php">Admin Staff</a></li>
      <li><a href="#brands.php">Employment Equity</a></li>
      <li><a href="#categories.php">Leave Managment</a></li>
      <li><a href="#products.php">Training/Workshops</a></li>
    </ul>
     </li>
  	   <?php if(has_permission('admin')): ?>

      <?php endif ;?>
      <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span id="text"></span>Accounts
    <span class="caret"></span>
    </a>
      <ul class="dropdown-menu" role="menu" id="text">
      <li><a href="accounts.php">Accounting Reports</a></li>
      <li><a href="archived.php">Archived</a></li>
      </ul>
    </li>
        <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span id="text"></span>Fresh/Health Equip
    <span class="caret"></span>
    </a>
    <ul class="dropdown-menu" role="menu" id="text">
      <li><a href="archived.php">Archived</a></li>
      <li><a href="brands.php">Brands</a></li>
      <li><a href="categories.php">Categories</a></li>
      <li><a href="products.php">Products</a></li>
    </ul>
     </li>
<!--     <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text">Fresh & Wearables
    <span class="caret"></span>
    </a>
      <ul class="dropdown-menu" role="menu" id="text">
      <li><a href="brands.php" id="text">Brands</a></li>
      <li><a href="categories.php" id="text">Categories</a></li>
      <li><a href="products.php" id="text">Products</a></li>
    </ul>
    </li> -->
       <li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"> Pharmacy
    <span class="caret"></span>
    </a>
      <ul class="dropdown-menu" role="menu" id="text">
      <li><a href="archived.php">Archived</a></li>
      <li><a href="brands.php">Brands</a></li>
      <li><a href="categories.php">Categories</a></li>
      <li><a href="products.php">Products</a></li>
      </ul>
    </li>
		<li class="dropdown">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" id="text"><span class="glyphicon glyphicon-user" id="text"></span>Hello <?=$user_data['first'];?>!
		<span class="caret"></span>
		</a>
		<ul class="dropdown-menu" role="menu" id="text">
      <li><a href="#admin_profile">Edit Profile</a></li>
		  <li><a href="change_password.php">Change Password</a></li>
      <li><a href="logout.php">Log Out</a></li>
		</ul>
	   </li>
  </div>
</nav>
