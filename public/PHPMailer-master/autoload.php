<?php
/**
 * PHPMailer SPL autoloader.
 */

if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
        spl_autoload_register(function ($classname) {
            $prefix = 'PHPMailer\\PHPMailer\\';
            $base_dir = __DIR__ . '/src/';

            $len = strlen($prefix);
            if (strncmp($prefix, $classname, $len) !== 0) {
                return;
            }

            $relative_class = substr($classname, $len);
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';

            if (file_exists($file)) {
                require $file;
            }
        });
    } else {
        spl_autoload_register(function ($classname) {
            $filename = dirname(__FILE__) . '/src/' . $classname . '.php';
            if (is_readable($filename)) {
                require $filename;
            }
        });
    }
}