<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Jonas Tomanga
 * @company Logic Plus Information Technologies CC
 */
class Session {

    private function __construct() {
	session_cache_limiter(false);
	session_start();
    }

    private static $instance = null;

    public static function start() {
	// Check if instance is already exists
	if (self::$instance == null) {
	    self::$instance = new Session();
	}
	return self::$instance;
    }

    private function __clone() {
	// Stopping Clonning of Object
    }

    private function __wakeup() {
	// Stopping unserialize of object
    }

    public static function getUserInfo() {
	return isset($_SESSION['userinfo']) ? $_SESSION['userinfo'] : "";
    }

    public static function setUserInfo($userinfo) {
	$_SESSION['userinfo'] = $userinfo;
    }

    public static function check() {
	return isset($_SESSION['userinfo']) ? true : false;
    }

    public static function destroy() {

	$_SESSION = array();

	if (ini_get("session.use_cookies")) {
	    $params = session_get_cookie_params();
	    setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]
	    );
	}

	return session_destroy() ? true : false;
    }

    public static function redirect() {
	header("location: /auth");
    }

}
