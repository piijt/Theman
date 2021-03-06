<?php

require_once './model/AuthI.php';

abstract class AuthA implements AuthI {
    protected static $sessvar = 'nAuth42'; // if set = logged on
    protected static $sessprof = 'nauth42p'; // profile of logged in user
    protected static $logInstance = false;
    protected $userId;
    protected $profile;

    protected function __construct($user, $profile) {
        $this->userId = $user;
        $this->profile = $profile;
    }


    public function getUserId() {
        return $this->userId;
    }

    public static function getLoginId() {
        return isset($_SESSION[self::$sessvar]) ? $_SESSION[self::$sessvar] : 'nobody';
    }

    public static function getProfile() {
        return isset($_SESSION[self::$sessprof]) ? $_SESSION[self::$sessprof] : 'regular';
    }

    public static function isAuthenticated() {
      return isset($_SESSION[self::$sessvar]) ? true : false;
    }

    public static function logout() {
        setcookie(session_name(), '', 0, '/');
        session_unset();
        session_destroy();
        session_write_close();
        unset($_SESSION[self::$sessvar]);
    }

    abstract public static function authenticate($user, $pwd);
    abstract protected static function dbLookUp($user, $pwd);
}
