<?php
    require 'php/autoloader.php';
    $tickets = new Tickets();
    $accounts = new Accounts();
    $userID = $_SESSION['userID'];

    if(!isset($userID) || $accounts->getUserApproved($userID) == 0)
    {
        header('location: index.php', true);
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
		<a href="createnewticket.php"><h1 class="logo">ForexNinja Help Desk</h1></a>

		<svg class="triangle">
			<polygon points="0,0 50,0 0,100"/>
		</svg>
	</div>

	<img class="placeholder" src="assets/stocks-placeholder.png" alt="placeholder">

	<div class="login-name">
	    Welcome <?= $accounts->getUsersName($userID) ?>
	</div>
</header>

<div class="wrapper">
    <div class="ticket-list">
		<p class="ticket-list-p">Your Tickets</p>
		<div class="scrollable">
            <?php
                if($accounts->getUserAdmin($userID) == 1)
                $allTickets = $tickets->getAllTickets();
            else
                $allTickets = $tickets->getUsersTickets($userID);

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

					<div class="status-circle <?= ($ticket[3] == 0) ? 'open' : 'closed' ?>"></div>

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
            <form class="create-form" action="submit.php" method="POST" enctype="multipart/form-data">
                <input type="text" name="title" id="title" placeholder="Title">
                <textarea name="question" placeholder="Enter question" id="create-textarea"></textarea>
                <input type="file" name="file">

                <input class="button" type="submit" name="submit" value="Submit" id="submit">
            </form>
		</div>
	</div>

	<nav class="content-box">

		<div>
			<h2>Menu</h2>

			<div class="nav-link-wrapper">
				<a href="createnewticket.php">Create New Ticket</a>
				<a href="settings.php">Settings</a>
                <?= ($accounts->getUserAdmin($_SESSION['userID']) == 1) ? '<a href="admin.php">Admin</a>' : '' ?>
			</div>
		</div>

		<div class="nav-logout-line">
			<a href = "logout.php"><button class="button logout">LOGOUT</button></a>
		</div>

	</nav>

</div>

</body>
</html>
