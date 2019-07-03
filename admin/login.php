<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$hashed = password_hash($password,PASSWORD_DEFAULT);
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
		$errors[] = 'You must enter a valid email.';
	}
	//check if password is more than 6 characters
	if(strlen($password)<6){
		$errors[] = 'Password must be at least 6 characters.';
	}

	  // check if email exist in the database
	  $query = $db->query("SELECT *FROM users WHERE   email = '$email'");
	  $user = mysqli_fetch_assoc($query);
	  $userCount =mysqli_num_rows($query);
	  if($userCount<1){
		  $errors[] = 'That email does not exist in our database';
	  }
	  if(!password_verify($password, $user['password'])){
		$errors[] = 'You entered incorrect password.';
	  }

       //check errors
     if(!empty($errors)){
		 echo display_errors($errors);
	 }else{
		 //login the user
		 $user_id = $user['id'];
		 login($user_id);
	 }
	}
	;?>

 </div>
  <h2 class="text-center"> Admin Login:</h2><hr>
  <form action="login.php" method="post">
    <div class="form-group">
	<label for="email">Email:</label>
	<input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
	</div>
	    <div class="form-group">
	<label for="password">Password:</label>
	<input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
	</div>
	<b><P class="text-center"><a href="change_password.php">Forgot password?</a></P><b>
	<div class="form-group">
	<input type="submit" style="width:100%" value="Admin Login" class="btn btn-primary"id="text">
	</div>
  </form>
  <b><P class="text-center"> Wanna Go Shopping? <a href="/eight/index.php" alt="home">  Apexcure.com</a></P><b>
</div>


<?php include 'includes/footer.php';?>
