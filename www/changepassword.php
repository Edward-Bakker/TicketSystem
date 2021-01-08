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
    <title>Change Password</title>
</head>
<body>
    <div class="mainBox">
    <h1>Change Password</h1>
    
        <form name="Input" action="changepassword.php" method="POST">

            <div class="input-wrap">
                <input type="Text" name="oldpassword" value="" placeholder="Old Password">
                <input type="Text" name="newpassword" value="" placeholder="New Password">
                <input type="Text" name="reppassword" value="" placeholder="Repeat Password">
                <input type="submit" name="submit"> 
            </div>
    
        </form>
    </div>
        
        
<?php
 if(isset($_POST['submit']))
 {
$oldPassword = $_POST["oldpassword"];
$newPassWord= $_POST['newpassword'];
$repeatPassWord= $_POST['reppassword'];
$passwordmatch=false;
if( $newPassWord==$repeatPassWord){     $passwordmatch=true;}
else { echo "The new passwords dont match";}
if($newPassWord==$oldPassword) {echo "The new password is the same as the old one ";}
if($passwordmatch==true)
{
$config = config::getDBConfig();
$link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
OR Die("Could not connect to database!" . mysqli_error($link));
$sql = "SELECT  id,password FROM accounts WHERE id = ?";

if ($stmt = $link->prepare($sql)) {
    $stmt->bind_param('s', $id);
    $stmt->execute()
            or die("Could not send the data to the database: " . $link->errno);
$stmt->bind_result($id, $password);
$stmt->store_result();
echo $password;


if(password_verify($oldPassword,$password))
{
   $sql= "UPDATE accounts SET password = ? Where id= ?";
   if($stmt=$link->prepare($sql)){
       $stmt->bind_param('ss',password_hash($newPassWord, PASSWORD_DEFAULT), $id );
       $stmt->execute()
          or die ("Could not update the password ". $link->errno);
          $stmt= mysqli_query($link, $sql);
        echo "Reached checkpoint";
   }

}
else { echo "The password doesnt match the old one ";

}
}
}
 }
?>




</body>
</html>
