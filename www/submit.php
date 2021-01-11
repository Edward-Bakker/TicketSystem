<?php require 'php/autoloader.php';

$config = config::getDBConfig();
$conn = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
OR Die("Could not connect to database!" . mysqli_error($link));

session_start();

$title = mysqli_real_escape_string($conn, $_POST['title']);
$question = mysqli_real_escape_string($conn, $_POST['question']);
$id = mysqli_real_escape_string($conn, $_SESSION['id']);

$msg = "";

if (isset($_POST['submit'])){
    // Get image name and give it a unique string so that it cannot have conflicts
    $filename = $_FILES['file']['name'];
    $randstring = bin2hex(random_bytes(10));
    $uniqfilename = $randstring . $filename;

    // Get text
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $id = mysqli_real_escape_string($conn, $_SESSION['id']);
    // image file directory
    $target = "uploads/" . basename($uniqfilename);

    $sql = "INSERT INTO tickets ( `subject`, `content`, `user_id`, `file`) VALUES ( '$title', '$question', '$id', '$uniqfilename')";
    // execute query
    if(mysqli_query($conn, $sql)){
        echo "Success";
    }
    else {
        echo "There was a error with executing the statement ". mysqli_error($conn);
    }
    header("Location:createnewticket.php?success");
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
        $msg = "Image uploaded successfully";
    }else{
        $msg = "Failed to upload image";
    }
}
?>
