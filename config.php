<?php
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'/eight/');
define('TROLLEY_COOKIE','SBwi72UCklwiqzz2');
define('TROLLEY_COOKIE_EXPIRE',time() + (86400 *30));
define('TAXRATE',0);//VAT

define('CURRENCY', 'zar');
define('CHECKOUTMODE', 'TEST');//to change to live once ready

if(CHECKOUTMODE == 'TEST'){
	define('STRIPE_PRIVATE', 'sk_test_yEFWvn0Ao2NUjFenAxUVcBOA');// FILL IN WITH STRIPE ACCOUNT DETAILS
	define('STRIPE_PUBLIC', 'pk_test_Mo8VqDFqzx2teP58xr3N8Jli');// FILL IN WITH STRIPE ACCOUNT DETAILS
}

if(CHECKOUTMODE == 'LIVE'){
	define('STRIPE_PRIVATE', '');// FILL IN WITH STRIPE ACCOUNT DETAILS
	define('STRIPE_PUBLIC', '');// FILL IN WITH STRIPE ACCOUNT DETAILS
}
