<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
include 'includes/head.php';
include'customer_errors.php';
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
?>

<style>
body{
	background-image:url("/eight/images/headerlogo/background.jpg");
	background-size: 100vw 100vh;
	background-attachment: fixed;
}
</style>
<div id="customer_login-form">
 <div>

    <?php
	if($_POST){
	//form validation
	if(empty($_POST['email']) || empty($_POST['password'])){
	$errors[] = 'You must provide email and password.';
	}

	//validation of email address
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors[] ='You must enter a valid email.';
	}
	//check if password is more than 6 characters
	if(strlen($password)<6){
		$errors[] ='Password must be at least 6 characters.';
	}

	  // check if email exist in the database
	  $query = $db->query("SELECT *FROM customers WHERE   email = '$email'");
	  $customer = mysqli_fetch_assoc($query);
	  $customerCount =mysqli_num_rows($query);
	  if($customerCount<1){
		  $errors[] ='That email does not exist in our database';
	  }
	  if(!password_verify($password, $customer['password'])){
		$errors[] ='The password does not match our records.Please try again.';
	  }

       //check errors
     if(!empty($errors)){
		 echo display_errors($errors);
	 }else{
		 //login the customer
		 $customer_id = $customer['id'];
		 customer_login($customer_id);
	 }
	}
	;?>
</div>
  <h2 class="text-center"> Customer Login:</h2><hr>
  <form action="customer_login.php" method="post">
    <div class="form-group">
	<label for="email">Email:</label>
	<input type="text" name="email" id="email" class="form-control" value="<?=$email;?>">
	</div>

	    <div class="form-group">
	<label for="password">Password:</label>
	<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
	</div>
	<b><P class="text-center"><a href="#" alt="home">Forgot password?</a></P><b>
	<div class="form-group">
	<input type="submit" style="width:100%" value="Login to your account" class="btn btn-primary" id="text">
	</div>
  </form>
  <b><P class="text-left">New with Apexcure?<a href="/eight/customer_register.php" alt="home">Register</a></P><b>
</div>
<?php include 'includes/footer.php';?>
