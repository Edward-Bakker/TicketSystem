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
}elseif($values["adminlevel"] === "0")
{
    echo "Not admin, please contact the admin, redirect in 5 seconds...";
	header("Refresh: 5; viewticket.php");
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
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Forex Ninja Admin Page</title>
</head>
<body>
    
    <header>
        <h1>Admin Page</h1>
    </header>  
        
    <?php
    // connects to database
    $config = config::getDBConfig();
    $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
    OR Die("Could not connect to database!" . mysqli_error($link));
    // takes data from the database and uses a while loop to pull all the data that exists
    $sql = "SELECT * FROM accounts ORDER BY id ASC";
        $stmt = mysqli_query($link, $sql);
        echo "<br>";
        echo "<table>";
        echo "<tr><th>" . "ID" . "</th><th>" . "name" . "</th><th>" . "email" . "</th><th>" . "password hash" . "</th><th>" . "adminlevel" . "</th><th>" . "approved" . "</th><th>" . "last login" . "</th><th>" . "Registered Date" . "</th><th>" . "Edit" . "</th></tr>";
        while ($row = mysqli_fetch_array($stmt)) 
        {
            echo "<tr class=\"hover\"><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td><td>" . $row["adminlevel"] . "</td><td>" . $row["approved"] . "</td><td>" . $row["last_login"] . "</td><td>" . $row["insert_time"]  . "</td><td>" . "<a href= 'admineditpage.php?id=" . $row["id"] . "'>EDIT</a></td></tr>";                                                         
        }
        echo "</table>";
        mysqli_close($link);
    
    ?>
</body>
</html>