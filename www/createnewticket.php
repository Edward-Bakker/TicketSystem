<?php require 'php/autoloader.php'; ?>
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
			<div class="ticket content-box">
				<a href="viewticket.php">
					<div class="ticket-list-top">
						<p>ID: 1</p>
						<p>John Smith</p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p">Help with USD/EUR</p>
					</div>

					<div class="status-circle closed"></div>

					<div class="ticket-bottom">
						<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
					</div>
				</a>
			</div>

			<div class="ticket content-box">
				<a href="viewticket.php">
					<div class="ticket-list-top">
						<p>ID: 2</p>
						<p>John Smith</p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p">Help with USD/EUR</p>
					</div>

					<div class="status-circle closed"></div>

					<div class="ticket-bottom">
						<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
					</div>
				</a>
			</div>

			<div class="ticket content-box selected">
				<a href="viewticket.php">
					<div class="ticket-list-top">
						<p>ID: 3</p>
						<p>John Smith</p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p">Help with USD/EUR</p>
					</div>

					<div class="status-circle open"></div>

					<div class="ticket-bottom">
						<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
					</div>
				</a>
			</div>

			<div class="ticket content-box">
				<a href="viewticket.php">
					<div class="ticket-list-top">
						<p>ID: 4</p>
						<p>John Smith</p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p">Help with USD/EUR</p>
					</div>

					<div class="status-circle open"></div>

					<div class="ticket-bottom">
						<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
					</div>
				</a>
			</div>

			<div class="ticket content-box">
				<a href="viewticket.php">
					<div class="ticket-list-top">
						<p>ID: 5</p>
						<p>John Smith</p>
					</div>

					<div class="ticket-list-title">
						<p class="ticket-list-p">Help with USD/EUR</p>
					</div>

					<div class="status-circle open"></div>

					<div class="ticket-bottom">
						<p>CREATED ON: 20/11/2020 TIME: 13:21</p>
					</div>
				</a>
			</div>

		</div>

	</div>

	<div class="create-wrapper">
		<h2>Create New Ticket</h2>
		<div class="create-ticket content-box">
			<form class="create-form" action="" method="post">
				<input type="text" name="title" id="title" placeholder="Title">
				<textarea name="question" placeholder="Enter question" id="create-textarea"></textarea>
				<input class="button" type="submit" name="submit" id="submit">
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
			<button class="button logout">LOGOUT</button>
		</div>

	</nav>

</div>

</body>
</html>