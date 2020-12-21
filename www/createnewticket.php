<?php require 'php/autoloader.php'; 
session_start();
if(($_SESSION["valid"] == false))
{
    echo "Not Logged in, please login to continue, redirect in 5 seconds...";
    header("Refresh: 5; login.php");
    return;
}elseif(($_SESSION["approved"] == false))
{
    echo "Not approved, please contact the admin, redirect in 5 seconds...";
    header("Refresh: 5; login.php");
    return;
}else
{
    
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>Create new ticket</title>
</head>
<body>

<header>
	<div class="logo-wrap">
		<h1 class="logo">ForexNinja Help Desk</h1>

		<svg class="triangle">
			<polygon points="0,0 50,0 0,100"/>
		</svg>
	</div>

	<img class="placeholder" src="assets/stocks-placeholder.png" alt="placeholder">

	<div class="login-name">
		<p>Welcome, Victor Peters</p>
	</div>
</header>

<div class="wrapper">
    <div class="ticket-list">
		<p class="ticket-list-p">Your Tickets</p>
		<div class="scrollable">
            <?php
                $tickets = new Tickets();
                $accounts = new Accounts();
                $allTickets = $tickets->getAllTickets();
                foreach($allTickets as $ticket):
            ?>
			<div class="ticket content-box">
				<a href="viewticket.php?id=<?= $ticket[0] ?>">
					<div class="ticket-list-top">
						<p>ID: <?= $ticket[0] ?></p>
						<p><?= $accounts->getUsersName($ticket[4]) ?></p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p"><?= $ticket[1] ?></p>
					</div>

					<div class="status-circle closed"></div>

					<div class="ticket-list-bottom">
						<p>CREATED ON: <?= $ticket[5] ?></p>
					</div>
				</a>
			</div>
            <?php endforeach; ?>
		</div>
	</div>

	<div class="create-wrapper">
		<h2>Create New Ticket</h2>
		<div class="create-ticket content-box">
			<form class="create-form" action="" method="post">
				<input type="text" name="title" id="title" placeholder="Title">
				<textarea name="question" placeholder="Enter question" id="create-textarea"></textarea>
				<input class="button" type="submit" name="submit" id="submit">
				<form action="upload.php" method="post" enctype="multipart/form-data">
  Upload A File:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload File" name="submit">
</form>
			</form>
		</div>
	</div>

	<nav class="content-box">

		<div>
			<h2>Menu</h2>

			<div class="nav-link-wrapper">
				<a href="createnewticket.php">Create New Ticket</a>
				<a href="settings.php">Settings</a>
			</div>
		</div>

		<div class="nav-logout-line">
			<a href = "login.php"><button class="button logout">LOGOUT</button></a>
		</div>

	</nav>

</div>

</body>
</html>
