<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/core/init.php';
   $name = isset($_POST['name']) ? $_POST['name'] : '';
   $email = isset($_POST['email']) ? $_POST['email'] : '';
   $street = isset($_POST['street']) ? $_POST['street'] : '';
   $street2 = isset($_POST['street2']) ? $_POST['street2'] : '';
   $city = isset($_POST['city']) ? $_POST['city'] : '';
   $state = isset($_POST['state']) ? $_POST['state'] : '';
   $zip_code = isset($_POST['zip_code']) ? $_POST['zip_code'] : '';
   $country = isset($_POST['country']) ? $_POST['country'] : '';
   $errors = array();
   $required = array(
	'full_name'      =>'Full Name',
	'email'          =>'Email',
	'street'         => 'Street Address',
	'city'           => 'City',
	'state'          => 'Province',
	'zip_code'       => 'Zip Code',
	'country'        => 'Country',
	);


	// check if all required field are filled in
	foreach($required as $f => $display){
		if(empty($_POST[$f]) || $_POST[$f] == ''){
			$errors[] = $display.' is required.';
		}
	}

	// check if valid email is used
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errors[] = 'Please enter a valid email.';
	}

if(!empty($errors)){
	 echo display_errors($errors);
}else{
	 echo 'passed';


}


?>
