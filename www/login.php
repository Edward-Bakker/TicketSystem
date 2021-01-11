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
            $accounts = new Accounts();
            if(isset($_SESSION['userID']) && $accounts->getUserApproved($_SESSION['userID']) == 1)
            {
                header('location: viewticket.php', true);
            }
            if(isset($_POST['submit']))
            {
                $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
                $password = filter_input(INPUT_POST, 'password');

                if(!empty($email) && !empty($password))
                {
                    if($accounts->login($email, $password))
                    {
                        session_regenerate_id();
                        $accounts->setLastLogin($email);
                        $accountID = $accounts->getUsersID($email);
                        $_SESSION['userID'] = $accountID;
                        header('location: viewticket.php', true);
                    }
                    else
                    {
                        $error = [true];
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

                <div class="input-wrap">
                    <input type="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" placeholder="Password" required>
                    <input type="submit" name="submit" value="Log in">
                    <?= (isset($error) && $error[0]) ? 'Wrong email, or password' : '' ?>
                </div>

                <div class="bottom-buttons">
                    <a href="mailto:victor.peters@nhlstenden.com">Reset password</a>
                    <a href="signup.php">Register</a>
                </div>

            </form>
        </div>
    </body>
</html>
