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
        public function getAllTickets()
        {
            $query = "SELECT id, subject, content, closed, user_id, created_at, updated_at, closed_at FROM tickets";

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
    }
?>
