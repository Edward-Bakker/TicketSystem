<?php require 'php/autoloader.php';?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin Edit Page</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Edit</h1>
        <hr>
           <?php
           $config = config::getDBConfig();
           $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
           OR Die("Could not connect to database!" . mysqli_error($link));
            
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            $sql = "SELECT * FROM accounts WHERE id=$id";
            $stmt = mysqli_query($link, $sql);
            $values = mysqli_fetch_array($stmt);
            ?>
            
        <form name="Input" method="POST">
            <input type="Text" name="name" value="<?php echo $values["name"]?>"> <b>Name</b> <br>
            <br>
            <input type="Text" name="email" value="<?php echo $values["email"]?>"> <b>Email</b> <br>
            <br>
            <input type="Text" name="password" value="<?php echo $values["password"]?>"> <b>Password (new password will be hashed automatically)</b> <br>
            <br>
            <input type="Text" name="adminlevel" value="<?php echo $values["adminlevel"]?>"> <b>Admin Level</b> <br>
            <br>
            <input type="Text" name="approved" value="<?php echo $values["approved"]?>"> <b>Approved</b> <br>
            <br>
            <input type="Submit" name="submit" value="Submit">
            <input type="Submit" name="back" value="Back">
        </form>


        <?php
         if(isset($_POST["back"]))
        {
             header("Location: admin.php");
        }

        if(isset($_POST["submit"]))
        {
                $name = filter_input(INPUT_POST , "name" , FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST , "email" , FILTER_SANITIZE_EMAIL);
                $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
                $adminlevel = $_POST["adminlevel"];
                $approved = $_POST["approved"];
                
                $accounts = new accounts();
                $accounts->editaccounts($id, $name, $email, $password, $adminlevel, $approved);
                header("Location: admin.php");
        }
        ?>
    </body>
</html>



