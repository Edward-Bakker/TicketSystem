<?php
    class Init {
        public function __construct()
        {
            $debugConfig = config::getDebugConfig();
            if(!$debugConfig->show_php_error)
            {
                ini_set('display_errors', 'Off');
            }
        }
    }
?>
