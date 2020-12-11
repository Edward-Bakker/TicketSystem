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
                <input type="submit" name="submit" value="Reset password">
            </form>
        </div>
    </body>
</html>
