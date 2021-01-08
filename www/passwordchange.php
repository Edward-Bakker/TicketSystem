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
            <form action="passwordchange.php" method="POST">
                
                <div class="input-wrap">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="currentPassword" placeholder="Enter your current password">
                    <input type="password" name="newPassword" placeholder="Enter new password" >
                    <input type="password" name="newPasswordConfirm" placeholder="Retype new password">
                    <input type="submit" name="submit" value="Reset password">
                </div>
                
            </form>
        </div>
        <?php
        if(isset($_POST['submit']))
        {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $currentPassword = filter_input(INPUT_POST, 'currentPassword');
            $newPassword = filter_input(INPUT_POST, 'newPassword');
            $newPasswordConfirm = filter_input(INPUT_POST, 'newPasswordConfirm');

            if(!empty($email) && !empty($currentPassword) && !empty($newPassword) && !empty($newPasswordConfirm))
            {
                $accounts = new Accounts();
                if($accounts->login($email, $currentPassword))
                {
                    if($newPassword === $newPasswordConfirm)
                    {
                        $newPassword=password_hash($newPassword, PASSWORD_DEFAULT);
                        $accounts->changepassword($email, $newPassword);
                        echo "You have successfully changed your password ";
                    }
                    else echo "New passwords fields dont match";
                }
                else echo "Credentials error";
            }
            else echo "Fill in all fields";
        }
        ?>
    </body>
</html>
