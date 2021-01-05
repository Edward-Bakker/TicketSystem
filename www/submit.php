<?php
 
$db_host = 'localhost';
$db_user = 'ticketsystem_user';
$db_pass = 'changeme';
$db_name = 'ticketsystem';
 
$conn = mysqli_connect($db_host, $db_user, $db_pass,$db_name)
OR Die("Could not connect to database!" . mysqli_error($conn));

$title = $_POST['title'];
$question = $_POST['question'];


$sql = "INSERT into tickets ('subject', 'content') values ($title, $question);";
mysqli_query($conn,$sql);



    

?>