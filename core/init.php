<?php
$db = mysqli_connect('localhost','apexcure','password','eight');
if(mysqli_connect_errno()){
	echo 'Database Connection failed with following error: '. mysqli_connect_error();
	die();
}
session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/eight/config.php';
require_once BASEURL.'helpers/helpers.php';
require BASEURL.'vendor/autoload.php';

$trolley_id = '';
if(isset($_COOKIE[TROLLEY_COOKIE])){
    $trolley_id = sanitize($_COOKIE[TROLLEY_COOKIE]);
}

if(isset($_SESSION['SBUser'])){
	$user_id = $_SESSION['SBUser'];
	$query = $db->query("SELECT * FROM users WHERE id = '$user_id'");
	$user_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$user_data['full_name']);
	$user_data['first'] = $fn[0];
	$user_data['last'] = $fn[1];
}


if(isset($_SESSION['success_flash'])){
	echo '<div class="bg-success"><p class="text-success text-center">'.$_SESSION['success_flash'].'</p></div>';
	unset($_SESSION['success_flash']);
}

if(isset($_SESSION['error_flash'])){
	echo '<div class="bg-danger"><p class="text-danger text-center">'.$_SESSION['error_flash'].'</p></div>';
	unset($_SESSION['error_flash']);
}
// customer info

if(isset($_SESSION['SBCustomer'])){
	$customer_id = $_SESSION['SBCustomer'];
	$query = $db->query("SELECT * FROM customers WHERE id = '$customer_id'");
	$customer_data = mysqli_fetch_assoc($query);
	$fn = explode(' ',$customer_data['full_name']);
	$customer_data['first'] = $fn[0];
	$customer_data['last'] = $fn[1];
}
