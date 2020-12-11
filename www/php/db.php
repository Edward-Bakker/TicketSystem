<?php
    class DB {
        protected $db_host;
        protected $db_user;
        protected $db_pass;
        protected $db_name;

        public function __construct()
        {
            $config = config::getDBConfig();

            $this->db_host = $config->db_host;
            $this->db_user = $config->db_user;
            $this->db_pass = $config->db_pass;
            $this->db_name = $config->db_name;
        }

        private $dbConnectionObject;

        protected function connect($query): mysqli_stmt
        {
            $this->dbConnectionObject = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

            if($this->dbConnectionObject !== false)
            {
                return $this->dbConnectionObject->prepare($query);
            }
            else
            {
                $error = new Error();

                $msg = "Unable to connect to the database. Code: " . mysqli_errno($this->dbConnectionObj) . ": " . mysqli_error($this->dbConnectionObj);
                $error->report($msg);
                return false;
            }
        }

        protected function close()
        {
            $this->dbConnectionObject->close();
        }
    }
?>
