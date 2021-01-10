<?php require 'php/autoloader.php';
session_start();
if(($_SESSION["valid"] == false))
{
    echo "Not Logged in, please login to continue, redirect in 5 seconds...";
	header("Refresh: 5; login.php");
	return;
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}

$id=$_SESSION["id"];
$config = config::getDBConfig();
$link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
OR Die("Could not connect to database!" . mysqli_error($link));
$sql = "SELECT approved, adminlevel FROM accounts WHERE id = $id";
$stmt = mysqli_query($link, $sql);
$values = mysqli_fetch_array($stmt);

if($values["approved"] === "0")
{
    echo "Not approved, please contact the admin, redirect in 5 seconds...";
	header("Refresh: 5; login.php");
	return;
	mysqli_stmt_close($stmt);
	mysqli_close($link);
}else
{

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/form.css">
    <title>Settings</title>
</head>
<body>
    <div class="mainBox">
    
    <h1>User Settings</h1>

        <?php
        //connects to database
        $config = config::getDBConfig();
        $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
        OR Die("Could not connect to database!" . mysqli_error($link));
        //gets id from the session
        $id = $_SESSION["id"];
        //gets all the data from the database where the id is from the url
        $sql = "SELECT name, email FROM accounts WHERE id=$id";
        $stmt = mysqli_query($link, $sql);
        $values = mysqli_fetch_array($stmt);
        ?>
            
        <form name="Input" action="settings.php" method="POST">

        <!-- dynamically inputs all data from the database into the form -->
           
            <div class="input-wrap">
                <input type="Text" name="name" value="<?php echo $values["name"]?>" placeholder="Name">
                <input type="Text" name="email" value="<?php echo $values["email"]?>" placeholder="Email">
                <input type="Submit" name="changePassword" value="Change Password">
                <input type="Submit" name="submit" value="Submit">
                <input type="Submit" name="back" value="Back">
            </div>
            
        </form>
    
    </div>
    
        <?php
        // takes the user back to the ticket page
         if(isset($_POST["back"]))
        {
             header("Location: viewticket.php");
        }

        if(isset($_POST["changePassword"]))
        {
            header("Location: passwordchange.php");
        }

        //filters all data and edits the database on submit to what was entered in the form
        if(isset($_POST["submit"]))
        {
                $name = filter_input(INPUT_POST , "name" , FILTER_SANITIZE_STRING);
                $email = filter_input(INPUT_POST , "email" , FILTER_SANITIZE_EMAIL);

                $accounts = new accounts();
                $accounts->editaccountssettings($id, $name, $email);
                header("Location: viewticket.php");
        }
        ?>
</body>
</html>
