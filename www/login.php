<?php require 'php/autoloader.php';
 session_start();
 $_SESSION["valid"] = false;
 $_SESSION["id"] = "";
 $_SESSION["name"] = "";
 ?>
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
                    if($accounts->login($email, $password))
                    {
                        $accounts->setLastLogin($email);
                        $_SESSION["valid"] = true;
                        $config = config::getDBConfig();
                        $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
                        OR Die("Could not connect to database!" . mysqli_error($link));
                        $sql = "SELECT id, name FROM accounts WHERE email = '$email'";
                        $stmt = mysqli_query($link, $sql);
                        while($values = mysqli_fetch_array($stmt))
                        {
                            $_SESSION["id"] = (int)$values["id"];
                            $_SESSION["name"] = $values["name"];
                            mysqli_stmt_close($stmt);
                            mysqli_close($link);
                            header("Location: viewticket.php");
                        }
                    }
                    else
                    {
                        echo "<div class =" .  "mainbox" . "<p>" . "Wrong login credentials" . "</p>" . "</div";
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
                </div>

                <div class="bottom-buttons">
                    <a href="mailto:victor.peters@nhlstenden.com">Reset password</a>
                    <a href="signup.php">Register</a>
                </div>

            </form>
        </div>
    </body>
</html>
