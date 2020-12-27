<?php require 'php/autoloader.php';
// session_start();
// if(($_SESSION["valid"] == false))
// {
//     echo "Not Logged in, please login to continue, redirect in 5 seconds...";
// 	header("Refresh: 5; login.php");
// 	return;
// 	mysqli_stmt_close($stmt);
// 	mysqli_close($link);
// }

// $id=$_SESSION["id"];
// $config = config::getDBConfig();
// $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
// OR Die("Could not connect to database!" . mysqli_error($link));
// $sql = "SELECT approved, adminlevel FROM accounts WHERE id = $id";
// $stmt = mysqli_query($link, $sql);
// $values = mysqli_fetch_array($stmt);

// if($values["approved"] === "0")
// {
//     echo "Not approved, please contact the admin, redirect in 5 seconds...";
// 	header("Refresh: 5; login.php");
// 	return;
// 	mysqli_stmt_close($stmt);
// 	mysqli_close($link);
// }elseif($values["adminlevel"] === "0")
// {
//     echo "Not admin, please contact the admin, redirect in 5 seconds...";
// 	header("Refresh: 5; viewticket.php");
// 	return;
// 	mysqli_stmt_close($stmt);
// 	mysqli_close($link);
// }else
// {
    
// }
?>
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
           //connects to database
           $config = config::getDBConfig();
           $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
           OR Die("Could not connect to database!" . mysqli_error($link));
            //gets id from the url with a get and filters the input so it will only accept a number
            $id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);
            //gets all the data from the database where the id is from the url
            $sql = "SELECT * FROM accounts WHERE id=$id";
            $stmt = mysqli_query($link, $sql);
            $values = mysqli_fetch_array($stmt);
            ?>
            
        <form name="Input" method="POST">
        <!-- dynamically inputs all data from the database into the form -->
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
        // takes the user back to the admin page
         if(isset($_POST["back"]))
        {
             header("Location: admin.php");
        }

        //filters all data and edits the database on submit to what was entered in the form
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



