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
    <title>Change Password</title>
</head>
<body>
    <h1>Change Password</h1>
    <hr>
    
    <form name="Input" method="POST">
            <input type="Text" name="oldpassword" value=""> <b>Old Password</b> <br>
            <br>
            <input type="Text" name="newpassword" value=""> <b>New Password</b> <br>
            <br>
            <input type="Text" name="reppassword" value=""> <b>Repeat Password</b> <br>
    </form>

<?php
$oldPassword = $_POST["oldpassword"];
?>

</body>
</html>