<?php
class AutoLoader {
    protected static $paths = array();
	
    public static function addPath($path) {
        $path = realpath($path);
        if ($path) {
            self::$paths[] = $path;
        }
    }
	
    public static function load($class) {
		
        $classPath = str_replace("\\", DIRECTORY_SEPARATOR, $class); // Do whatever logic here
        foreach (self::$paths as $path) {
            $maybePath = $path . DIRECTORY_SEPARATOR . $classPath . ".php";
            if (is_file($maybePath)) {
                require_once($maybePath);
                break;
            }
        }
    }
}
spl_autoload_register(array('AutoLoader', 'load'));
AutoLoader::AddPath("php-verisure");
?>