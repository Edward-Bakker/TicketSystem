<?php require 'php/autoloader.php';
 
$db_host = "localhost";
$db_user = "ticketsystem_user";
$db_pass = "changeme";
$db_name = "ticketsystem";
 
$conn = new mysqli($db_host, $db_user, $db_pass,$db_name) or die("Connect failed: %s\n". $conn -> error);

session_start();

$title = mysqli_real_escape_string($conn, $_POST['title']);
$question = mysqli_real_escape_string($conn, $_POST['question']);
$id = mysqli_real_escape_string($conn, $_SESSION['id']);


$sql = "INSERT into tickets(`user_id`, `subject`, `content`) VALUES (?, ?, ?);";
$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)){
        echo'Database error';
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $id, $title, $question);
        mysqli_stmt_execute($stmt);
        header("Location:createnewticket.php?success");
    }
   //$title = filter_input(INPUT_POST, 'title', FILTER_DEFAULT);