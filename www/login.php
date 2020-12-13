<?php require 'php/autoloader.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="css/form.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <?php
            if(isset($_POST['submit']))
            {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, 'password');

                if(!empty($email) && !empty($password))
                {
                    $accounts = new Accounts();
                    if($accounts->login($email, $password)) {
                        // Correct login credentials
                    } else {
                        // Wrong login credentials
                    }
                }
            }
        ?>
        <!--  This is for the yellow box -->
        <div class ="mainBox">
            <!-- Main header -->
            <h1>ForexNinja</h1>

            <!-- Login form -->
            <form action="login.php" method="POST">
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="submit" name="submit" value="Log in">
                <a href="passwordreset.php">Forgot password</a>
            </form>
        </div>
    </body>
</html>
