<?php require 'php/autoloader.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/style.css">
	<meta charset="utf-8">
	<title>Your Tickets</title>
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

	<div class="active-ticket content-box">
		<div class="ticket-top">

			<div class="line">
				<button class="button">Delete ticket</button>
			</div>
			<h1>Help with USD/EUR</h1>

		</div>

		<p class="ticket-content">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>

		<form class="answer-form" action="" method="post">
			<label for="answer">Answer</label>
			<textarea name="answer" id="answer"></textarea>
		</form>

		<div class="ticket-bottom">
			<p>John Smith</p>

			<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
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
			<button class="button logout">LOGOUT</button>
		</div>

	</nav>

</div>

</body>
</html>
