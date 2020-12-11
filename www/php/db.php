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

            if($this->dbConnectionObject->connect_error) {
                $debugConfig = config::getDebugConfig();

                if($debugConfig->show_error)
                {
                    die('Connect Error (' . $this->dbConnectionObject->connect_errno . ') ' . $this->dbConnectionObject->connect_error);
                }
                else
                {
                    die();
                }
            }

            return $this->dbConnectionObject->prepare($query);
        }

        protected function close()
        {
            $this->dbConnectionObject->close();
        }
    }
?>
