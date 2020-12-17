<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forex Ninja Admin Page</title>
    <style>
    table, th, td{
    border: 1px solid black;
    }
    </style>
</head>
<body>
<h1>Admin Page</h1>
<hr>
    <?php
    $link = mysqli_connect("localhost", "root", "", "ticketsystem")
    OR Die("Could not connect to database!" . mysqli_error($link));
    
    $sql = "SELECT * FROM accounts ORDER BY id ASC";
        $stmt = mysqli_query($link, $sql);
        echo "<br>";
        echo "<table>";
        echo "<tr><th>" . "ID" . "</th><th>" . "name" . "</th><th>" . "email" . "</th><th>" . "password hash" . "</th><th>" . "adminlevel" . "</th><th>" . "approved" . "</th><th>" . "last login" . "</th><th>" . "Registered Date" . "</th><th>" . "Edit" . "</th></tr>";
        while ($row = mysqli_fetch_array($stmt)) 
        {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["email"] . "</td><td>" . $row["password"] . "</td><td>" . $row["adminlevel"] . "</td><td>" . $row["approved"] . "</td><td>" . $row["last_login"] . "</td><td>" . $row["insert_time"]  . "</td><td>" . "<a href= 'admineditpage.php?id=" . $row["id"] . "'>EDIT</a></td></tr>";                                                         
        }
        echo "</table>";
        mysqli_close($link);
    
    ?>
</body>
</html>