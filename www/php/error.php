<?php
    class Error {
        public function report($msg)
        {
            error_log($msg);
        }
    }
?>
