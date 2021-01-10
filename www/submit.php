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

$msg = "";

if (isset($_POST['submit'])){
    // Get image name
    $file = $_FILES['file']['name'];
    // Get text
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $id = mysqli_real_escape_string($conn, $_SESSION['id']);
    // image file directory
    $target = "uploads/".basename($file);

    $sql = "INSERT INTO tickets ( `subject`, `content`, `user_id`) VALUES ( '$title', '$question', '$id')";
    // execute query
    if(mysqli_query($conn, $sql)){
        echo "Success";
    }
    else {
        echo "There was a nerror with executing the statement ". mysqli_error($conn);
    }
    header("Location:createnewticket.php?success");
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
}
?>
