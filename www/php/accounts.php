<?php
    class Accounts extends DB
    {
        // Takes an email, and password and checks
        // whether the password matches the password in
        // the database, returns true on correct password
        public function login($email, $password)
        {
            $query = "SELECT password FROM accounts WHERE email = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('s', $email);

                $stmt->execute();

                $stmt->bind_result($passwordDB);

                $stmt->store_result();

                $result = false;
                if($stmt->num_rows === 1)
                {
                    while($stmt->fetch())
                    {
                        if(password_verify($password, $passwordDB))
                        {
                            $result = true;
                        }
                    }
                }
                $stmt->close();
            }
            $this->close();
            return $result;
        }

        // Takes username, email, password
        // stores it in the database with
        // the password hashed
        public function register($username, $email, $password)
        {
            $query = "SELECT email FROM accounts WHERE email = ?";
            $emailTaken = false;
            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('s', $email);

                $stmt->execute();

                $stmt->store_result();

                if($stmt->num_rows >= 1)
                {
                    $emailTaken = true;
                }
            }

            if(!$emailTaken)
            {
                $query = "INSERT INTO accounts (name, email, password) VALUES (?, ?, ?)";
                $password = password_hash($password, PASSWORD_DEFAULT);

                if($stmt = $this->connect($query))
                {
                    $stmt->bind_param('sss', $username, $email, $password);

                    $stmt->execute();

                    $stmt->close();
                }
                $this->close();
            } else {
                return "Email taken";
            }
        }

        // Gets the user's username
        public function getUsersName($id)
        {
            $query = "SELECT name FROM accounts WHERE id = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param('i', $id);

                $stmt->execute();

                $stmt->bind_result($username);

                $stmt->store_result();

                $result = null;
                if($stmt->num_rows !== 0)
                {
                    while($stmt->fetch())
                    {
                        $result = $username;
                    }
                }
                $stmt->close();
            }
            $this->close();
            return $result;
        }

        public function editaccounts($id, $name, $email, $password, $adminlevel, $approved)
        {
            $query = "UPDATE accounts 
            SET name = ?, email= ?, password = ?, adminlevel = ?, approved = ? WHERE id = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param("ssssss", $name, $email, $password, $adminlevel, $approved, $id);

                $stmt->execute();

                $stmt->close();
            }
            $this->close();
        }

        public function editaccountssettings($id, $name, $email)
        {
            $query = "UPDATE accounts 
            SET name = ?, email= ? WHERE id = ?";

            if($stmt = $this->connect($query))
            {
                $stmt->bind_param("sss", $name, $email, $id);

                $stmt->execute();

                $stmt->close();
            }
            $this->close();
        }
    }
?>
