<?php require 'php/autoloader.php';
session_start();
// if(($_SESSION["valid"] == false))
// {
//     echo "Not Logged in, please login to continue, redirect in 5 seconds...";
// 	header("Refresh: 5; login.php");
// 	return;
// 	mysqli_stmt_close($stmt);
// 	mysqli_close($link);
// }

// $id=$_SESSION["id"];
// $config = config::getDBConfig();
// $link = mysqli_connect($config->db_host, $config->db_user, $config->db_pass, $config->db_name)
// OR Die("Could not connect to database!" . mysqli_error($link));
// $sql = "SELECT approved, adminlevel FROM accounts WHERE id = $id";
// $stmt = mysqli_query($link, $sql);
// $values = mysqli_fetch_array($stmt);

// if($values["approved"] === "0")
// {
//     echo "Not approved, please contact the admin, redirect in 5 seconds...";
// 	header("Refresh: 5; login.php");
// 	return;
// 	mysqli_stmt_close($stmt);
// 	mysqli_close($link);
// }else
// {

// }
?>
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
		<?php //echo "<p>" . "Welcome, " . $_SESSION["name"] . "</p>"  ?>
	</div>
</header>

<div class="wrapper">
	<div class="ticket-list">
		<p class="ticket-list-p">Your Tickets</p>
		<div class="scrollable">
            <?php
                $tickets = new Tickets();
				$accounts = new Accounts();

				$ticketID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

				if(isset($ticketID) && !empty($ticketID))
				{
					$ticketContent = $tickets->getTicket($ticketID);
                }

                $ticketExists = false;
                if(isset($ticketContent) && $ticketContent !== [])
                {
                    $ticketExists = true;
                    // Check if user is admin, or user is ticket owner
                    if($accounts->getUserAdmin($_SESSION["id"]) == 0 && $ticketContent[4] !== $_SESSION["id"])
                    {
                        header('location: viewticket.php', true);
                    }
                }

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
			<h1><?= ($ticketExists) ? $ticketContent[1] : '' ?></h1>
		</div>

		<p class="ticket-content scrollable">
            <?php
            if($ticketExists)
            {
                if($ticketContent[4] === $_SESSION["id"])
                    echo '<div class="comment own">' . $ticketContent[2] . '</div>';
                else
                    echo '<div class="comment">' . $ticketContent[2] . '</div>';

                $allComments = $tickets->getTicketComments($ticketID);
                foreach($allComments as $comment)
                {
                    if($comment[3] === $_SESSION["id"])
                        echo '<div class="comment own"><p>' . $comment[1] . '</p></div>';
                    else
                        echo '<div class="comment"><p>' . $comment[1] . '</p><br> - <i>' . $accounts->getUsersName($comment[3]) . '</i></div>';
                }
            }
            ?>
		</p>

		<form class="answer-form" action="" method="post">
			<label for="answer">Answer</label>
			<textarea name="answer" id="answer"></textarea>
		</form>

		<div class="ticket-bottom">
            <p><?= ($ticketExists) ? $accounts->getUsersName($ticketContent[4]) : '' ?></p>

            <p>CREATED ON: <?= ($ticketExists) ? $ticketContent[5] : '' ?></p>
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
			<a href="login.php"><button class="button logout">LOGOUT</button></a>
		</div>

	</nav>

</div>

</body>
</html>
