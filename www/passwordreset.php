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
            <form action="passwordreset.php" method="POST">
                <input type="email" name="email" placeholder="Email">
                <input type="submit" name="password-reset-submit" value="Reset password">
            </form>
        </div>
        <?php
        $newpasswordgenerated = false;
        if (isset($_POST["password-reset-submit"])) {
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



//Connecting to the sql and changing the current password to the hashed one 
            $conn = mysql_connect('localhost', 'root', '', 'ticketsystem');
            if (!$conn) {
                DIE("Could not connect: " . mysqli_error($conn));
            }
            $selectDB = mysqli_select_db($conn, 'ticketsystem');
            if ($selectDB) {

                $sql = "UPDATE accounts
        SET password = $hashPassword,
        WHERE email = $email";

                if ($statement = mysqli_prepare($conn, $sql)) {
                    if (mysqli_stmt_execute($statement)) {
                        echo 'Success';
                        mysqli_stmt_close($statement);
                        $newpasswordgenerated = true;
                    } else {
                        echo ' Couldnt execute sql' . mysqli_error($conn);
                    }
                } else {
                    echo "Failed to prepare sql" . mysqli_error($conn);
                }
            } else {
                echo ' failed to select database' . mysqli_error($conn);
            }
            mysqli_close($conn);
        }
 $newpasswordgenerated=true;

 

        //Sending the email with the password 
        if ($newpasswordgenerated == true) {
            echo "You have reached this part" ;
            $to_email = $email;
            $subject = 'New password';
            $message = 'Your newly generated password is ' . $newPass;
            $headers = 'From: noreply @ company . com';
            
            $success = mail($to_email, $subject, $message, $headers);
            if ($success) {
                echo "Sent email";
            }
            else 
            {
                echo "Fuckoff";
            }
        }
            
        
        ?>


    </body>
</html>
