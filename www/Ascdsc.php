<?php require 'php/autoloader.php'; ?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <title>Ascending/Descending sorting</title>
</head>

<body>
    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
        <input type=submit name="Ascending" value="Ascending">
        <input type=submit name="Descending" value="Descending">
    </form>
    <?php

    $config = config::getDBConfig();
    $servername = $config->db_host;
    $username = $config->db_user;
    $password = $config->db_pass;
    $dbname = $config->db_name;

    //function which sorts by Ascending
    if (isset($_POST['Ascending'])) {

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname)
            or die("error");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error($conn));
        }

        // getting data from the database
        $sql_Insert = "SELECT accounts.name, tickets.subject
                            FROM accounts
                            LEFT JOIN tickets ON tickets.id=accounts.id
                            ORDER BY subject,name";
        $stmt_Insert = mysqli_prepare($conn, $sql_Insert);
        if ($stmt_Insert = mysqli_prepare($conn, $sql_Insert)) {
            mysqli_stmt_execute($stmt_Insert);
            mysqli_stmt_bind_result($stmt_Insert, $a, $b);
            mysqli_stmt_store_result($stmt_Insert);
        } else {
            echo mysqli_error($conn);
        }
        if (mysqli_stmt_num_rows($stmt_Insert) >= 0) {
            while (mysqli_stmt_fetch($stmt_Insert)) {
                echo $a . $b . "<br>";
            }
        } else {
            echo "There was an error:" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    //function which sorts by descending
    if (isset($_POST['Descending'])) {

        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname)
            or die("error");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error($conn));
        }

        // getting data from the database

        $sql_Insert = "SELECT accounts.name, tickets.subject
                            FROM accounts
                            LEFT JOIN tickets ON tickets.id=accounts.id
                            ORDER BY subject DESC ,name DESC";
        $stmt_Insert = mysqli_prepare($conn, $sql_Insert);
        if ($stmt_Insert = mysqli_prepare($conn, $sql_Insert)) {
            mysqli_stmt_execute($stmt_Insert);
            mysqli_stmt_bind_result($stmt_Insert, $a, $b);
            mysqli_stmt_store_result($stmt_Insert);
        } else {
            echo mysqli_error($conn);
        }
        if (mysqli_stmt_num_rows($stmt_Insert) >= 1) {
            while (mysqli_stmt_fetch($stmt_Insert)) {
                echo $a . $b . "<br>";
            }
        } else {
            echo "There was an error:" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
