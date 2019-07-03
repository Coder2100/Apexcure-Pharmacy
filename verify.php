<?php
/* Verifies email for registered customers email, the link to this page
   is included in the customer_register.php email message
*/
require_once 'core/init.php';
session_start();

// Make sure email and hash variables aren't empty
if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash']))
{
    $email = $mysqli->escape_string($_GET['email']);
    $hash = $mysqli->escape_string($_GET['hash']);

    // Select user with matching email and hash, who hasn't verified their account yet (active = 0)
    $result = $mysqli->query("SELECT * FROM users WHERE email='$email' AND hash='$hash' AND active='0'");

    if ( $result->num_rows == 0 )
    {
        $_SESSION['message'] = "Email has already been verified or the URL is invalid!";

        header("location: error.php");
    }
    else {
        $_SESSION['message'] = "Your email has been verified!";

        // Set the user status to active (active = 1)
        $mysqli->query("UPDATE users SET active='1' WHERE email='$email'") or die($mysqli->error);
        $_SESSION['active'] = 1;

        header("location: success.php");
    }
}
else {
    $_SESSION['message'] = "Invalid parameters provided for email verification!";
    header("location: error.php");
}
?>
