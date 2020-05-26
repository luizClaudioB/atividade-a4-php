<?php

class Logger {
    public static $instance;

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new Logger();
        }

        return self::$instance;
    }

    public function log($content) {
        file_put_contents('temp/logs.txt', "\n".date('Y/m/d H:i:s').':'.$content, FILE_APPEND);
    }
}