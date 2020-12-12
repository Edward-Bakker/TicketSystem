<?php require 'php/autoloader.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Password reset</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <!--  This is for the yellow box -->
        <div class ="mainBox">
            <!-- Main header -->
            <h1>ForexNinja</h1>

            <!-- Password reset form -->
            <form action="" method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="submit" name="password-reset-submit" value="Reset password">
            </form>
        </div>
        <?php

if(isset($_POST["password-reset-submit"]))
{
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

function randomPassword() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array(); 
    $alphaLength = strlen($alphabet) - 1; 
    for ($i = 0; $i < 10; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); 
}

$newPass = randomPassword();

$hashPassword = password_hash($newPass, PASSWORD_DEFAULT);

$sql = "UPDATE accounts
        SET password = $hashPassword,
        WHERE email = $email";
}

?>
    </body>
</html>
