<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
include 'includes/head.php';
$first_name = ((isset($_POST['first_name']))?sanitize($_POST['first_name']):'');
$first_name = trim($first_name);
$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm= ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$errors = array();
?>
<style>
body{
	background-image:url("/eight/images/headerlogo/background.jpg");
	background-size: 100vw 100vh;
	background-attachment: fixed;
}
</style>
<div id="customer_register-form">

<div>

<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

	// check if email already exist
	$customerQuery = $db->query("SELECT * FROM customers WHERE email = '$email'");
	$customerCount = mysqli_num_rows($customerQuery);
		if($customerCount != 0){
			$errors[] ='This email already exists in our database.Register with different email address';
		}
	//required fields
	$required = array('name', 'email', 'password');
		foreach ($required as $f){
			if(empty($_POST[$f])){
				$errors[] = 'You must fill out all fields';
				break;
			}
		}
	//check if password is more than 6 characters
	if(strlen($password)<6){
		$errors[] = 'Password must be at least 6 characters.';
	}
	// password match check
	//if($password !=$confirm){
		//	$errors[] = 'Your password your entered does not match.';
		//}

	//validation of email address
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors[] = 'You must enter a valid email.';
	}

	    if(!empty($errors)){
		 echo display_errors($errors);
	 }else{

		 // register customer to the database
    $hashed = password_hash($password,PASSWORD_DEFAULT);
	$sql=("INSERT INTO customers (full_name,email,password) VALUES ('$name','$email','$hashed')");
	$_SESSION['success_flash'] = 'You have successfuly registered.Please login below!';
	header('Location: customer_login.php');
		 }
	}

?>
</div>
<h2 class="text-center">Create Account:</h2>
  <form action="customer_register.php" method="post">
  <div class="form-group">
	<label for="name">Name:</label>
	<input type="text" name="first_name" class="form-control" value="<?=$first_name;?>">
	</div>
    <div class="form-group">
	<label for="email">Email:</label>
	<input type="email" name="email" class="form-control" value="<?=$email;?>">
	</div>
	    <div class="form-group">
	<label for="password"> Create Password:</label>
	<input type="password" name="password"  class="form-control" value="<?=$password;?>">
	</div>

	<div class="form-group">
	<input type="submit" style="width:100%" value="Register Apexcure Account" class="btn btn-primary"id="text">
	</div>

</form>
<P1 class="text-left">By creating an account, you agree to Apexcure's<a href="#" > Terms of Use</a></P1 class="text-center"> and <a href="#" ><p1.1></p1.1> Privacy Policy.</a><br><br>
<b>	<P2 class="text-left">Already have an account?<a href="customer_login.php" > Login here</a></P2><b>
  </div>




<?php ;?>
