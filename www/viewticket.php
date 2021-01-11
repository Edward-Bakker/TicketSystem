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
    <title>Your Tickets</title>
</head>

<body>

    <header>
        <div class="logo-wrap">
            <a href="viewticket.php"><h1 class="logo">ForexNinja Help Desk</h1></a>

            <svg class="triangle">
                <polygon points="0,0 50,0 0,100" />
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
                $ticketID = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

                if (isset($ticketID) && !empty($ticketID)) {
                    $ticketContent = $tickets->getTicket($ticketID);
                }

                $ticketExists = false;
                if (isset($ticketContent) && $ticketContent !== []) {
                    $ticketExists = true;
                    if (isset($_POST['delete'])) {
                        $status = 1;
                        if ($ticketContent[3])
                            $status = 0;

                        $tickets->setTicketStatus($ticketID, $status);
                        header('location: viewticket.php?id=' . $ticketID, true);
                    }

                }

                if($accounts->getUserAdmin($userID) == 1)
                    $allTickets = $tickets->getAllTickets();
                else
                    $allTickets = $tickets->getUsersTickets($userID);

                foreach ($allTickets as $ticket) :
                ?>
                    <div class="ticket content-box <?php if($_GET['id'] == $ticket[0]){echo("selected");}  ?>">
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

        <div class="active-ticket content-box">
            <div class="ticket-top">

                <div class="line">
                    <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">
                        <input class="button" type="submit" name="submit-close" value="<?= ($ticketExists && !$ticketContent[3]) ? 'Close' : 'Open' ?> Ticket" id="submit">
                    </form>
                </div>
                <h1><?= ($ticketExists) ? $ticketContent[1] : '' ?></h1>
            </div>

            <div class="ticket-content scrollable">
                <?php
                if ($ticketExists)
                {
                    if ($ticketContent[4] === $userID)
                        echo '<div class="comment own">' . $ticketContent[2] . '</div>';
                    else
                        echo '<div class="comment">' . $ticketContent[2] . '</div>';

                    $allComments = $tickets->getTicketComments($ticketID);
                    foreach ($allComments as $comment)
                    {
                        if ($comment[3] === $userID)
                            echo '<div class="comment own"><p>' . $comment[1] . '</p></div>';
                        else
                            echo '<div class="comment"><p>' . $comment[1] . '</p><br> - <i>' . $accounts->getUsersName($comment[3]) . '</i></div>';
                    }
                }
                ?>
            </div>

            <?php if($ticketExists && !$ticketContent[3]): ?>
            <form class="answer-form" action="<?= $_SERVER['REQUEST_URI'] ?>" method="post" enctype="multipart/form-data">
                <label for="answer">Answer</label>
                <textarea name="answer" id="answer"></textarea>
                <input type="file" name="file">

                <input class="button" type="submit" name="submit" value="Submit" id="submit">
            </form>
            <?php endif; ?>

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
                    <?= ($accounts->getUserAdmin($userID) == 1) ? '<a href="admin.php">Admin</a>' : '' ?>
                </div>
            </div>

            <div class="nav-logout-line">
                <a href="logout.php"><button class="button logout">LOGOUT</button></a>
            </div>

        </nav>

    </div>

</body>

</html>
