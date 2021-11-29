<?php
namespace controller;

class Session {
    private static $instance;
    private static $inactive;
    private static $sessionTTL;
    public static $timeoff;
    
    private function __construct() {
        self::$inactive = 10;
        if (self::get('timeout' != null )) {
            self::$sessionTTL = time() - self::get('timeout');
            if(self::$sessionTTL > self::$inactive) {
                self::destroy();
                self::$timeoff = true;
            }
        }
        self::set('timeout', time());
    }
    
    public static function init() {
        session_start();
        if(is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public static function set($name, $value) {
        $_SESSION[$name] = $value;
    }
    
    public static function get($name) {
        return (isset($_SESSION[$name])) ? $_SESSION[$name] : null;
    }
    
    public static function delete($name) {
        if (self::get($name) != null) {
            unset($_SESSION[$name]);
        }
    }
    
    public static function destroy() { 
        session_destroy();
    }

    static function expired(){
        $expire_time = 30 * 60;
        if($_SESSION['last_activity'] < time()-$expire_time) {
            self::destroy();
            header('Location: login');
        }else {
            $_SESSION['last_activity'] = time();
        }
    }
    
    public static function verifyActivity() {
        /*if (URL != 'login') {
            self::expired();
        }*/
    } 
    
    public static function verifyAccess($dir){
        /*if (isset($_SESSION["user"])){ 
            if (!$found && $file !== 'index') {
               header('Location: dashboard');
            } 
        }*/
    } 
}
