<?php
    class Config {
        public static function getDBConfig()
        {
            $ini = (object) parse_ini_file('../config.ini', true);
            $config = $ini->database;

            return (object) $config;
        }

        public static function getDebugConfig()
        {
            $ini = (object) parse_ini_file('../config.ini', true);
            $config = $ini->debug;

            return (object) $config;
        }
    }
?>
