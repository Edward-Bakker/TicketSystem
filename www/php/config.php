<?php
    class Config {
        public static function getDBConfig()
        {
            $ini = (object) parse_ini_file('../config.ini', true);
            $config = $ini->database;

            return (object) $config;
        }
    }
?>
