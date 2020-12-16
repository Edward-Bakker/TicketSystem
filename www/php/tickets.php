<?php
    class Tickets extends DB
    {
        // Gets all tickets from specific user
        public function getUsersTickets($userID)
        {
            $query = "SELECT id, subject, content, closed, user_id, created_at, updated_at, closed_at FROM tickets WHERE used_id = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('i', $userID);

                $stmt->execute();

                $stmt->bind_result($id, $subject, $content, $closed, $userID, $createdAt, $updatedAt, $closedAt);

                $stmt->store_result();

                $result = [];
                if($stmt->num_rows !== 0)
                {
                    while($stmt->fetch())
                    {
                        array_push($result, [$id, $subject, $content, $closed, $userID, $createdAt, $updatedAt, $closedAt]);
                    }
                }
                $stmt->close();
            }
            $this->close();
            return $result;
        }

        // Gets all tickets for the admin
        // or only the flagged ones if
        // flagged paramater is true
        public function getAllTickets($flagged = false)
        {
            if($flagged)
            {
                $query = "SELECT id, subject, content, closed, user_id, created_at, updated_at, closed_at FROM tickets WHERE flagged = '1'";
            }
            else
            {
                $query = "SELECT id, subject, content, closed, user_id, created_at, updated_at, closed_at FROM tickets";
            }

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('i', $userID);

                $stmt->execute();

                $stmt->bind_result($id, $subject, $content, $closed, $userID, $createdAt, $updatedAt, $closedAt);

                $stmt->store_result();

                $result = [];
                if($stmt->num_rows !== 0)
                {
                    while($stmt->fetch())
                    {
                        array_push($result, [$id, $subject, $content, $closed, $userID, $createdAt, $updatedAt, $closedAt]);
                    }
                }
                $stmt->close();
            }
            $this->close();
            return $result;
        }

        // Sets whether the ticket is
        // flagged or not depending
        // on the parameters
        public function setTicketFlag($id, $flagged)
        {
            $query = "UPDATE tickets SET flagged = ? WHERE id = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('si', $flagged, $id);

                $stmt->execute();

                $stmt->close();
            }
            $this->close();
        }
    }
?>
