<?php
    class AutoLoader {
        public static function register()
        {
            spl_autoload_register(function ($className)
            {
                $file = 'php/' . strtolower($className) . '.php';
                if(file_exists($file))
                {
                    require $file;
                    return true;
                }
                return false;
            });
        }
    }

    AutoLoader::register();
    $init = new Init();
?>
