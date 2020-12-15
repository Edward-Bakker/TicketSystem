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
    }
?>
