<?php
require 'php/autoloader.php';

    $accounts = new Accounts();
    $tickets = new Tickets();

    $userID = $_SESSION['userID'];
    if(!isset($userID) || $accounts->getUserApproved($userID) == 0)
    {
        header('location: index.php', true);
    }

    if(isset($_POST['submit']))
    {
        $comment = filter_input(INPUT_POST, 'answer', FILTER_SANITIZE_STRING);
        $ticketID = $_GET["id"];

        if(file_exists($_FILES['file']['tmp_name']) || is_uploaded_file($_FILES['file']['tmp_name']))
        {
            $file = $_FILES['file']['tmp_name'];
            $fileName = $_FILES['file']['name'];

            $filehandler = new Filehandler();

            if($return = $filehandler->uploadfile($file, $fileName))
            { 
                if(!empty($comment))
                {
                    if(in_array($return[1], ['png', 'jpeg'], true))
                    {
                        $comment = $comment . '<br><img src="' . $return[0] . '" alt="Question image">';
                    }
                    elseif (in_array($return[1], ['pdf'], true))
                    {
                        $comment = $comment . '<br><a href="' . $return[0] . '" target="_blank"">PDF</a>';
                    }
                    $tickets->commentTicket($comment, $ticketID, $userID);
                }
            }
            else
            {
                if(!empty($comment))
                {
                    $tickets->commentTicket($comment, $ticketID, $userID);
                }
            }
        }
     }
   // header ('location: viewticket.php');
?>