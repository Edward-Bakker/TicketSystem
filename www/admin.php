<?php
    require 'php/autoloader.php';
    $accounts = new Accounts();
    if(!isset($_SESSION['userID']) || $accounts->getUserAdmin($_SESSION['userID']) == 0)
    {
        header('location: index.php', true);
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
        <h1>Admin page</h1>
        <a href="viewticket.php">Head back to tickets</a>
    </header>

    <?php
        $allUsers = $accounts->getAllUsers();
    ?>
    <table>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Admin Level</th>
                <th>Approved</th>
                <th>Last Login</th>
                <th>Registration Date</th>
                <th></th>
            </tr>
            <?php foreach ($allUsers as $element): ?>
                <tr><td><?= $element[0] ?></td><td><?= $element[1] ?></td><td><?= $element[2] ?></td><td><?= $element[3] ?></td><td><?= $element[4] ?></td><td><?= $element[5] ?></td><td><?= $element[6] ?></td><td><a href="admineditpage.php?id=<?= $element[0] ?>">EDIT</a></td></tr>
            <?php endforeach; ?>
        </table>
</body>
</html>
