<?php

/**
 * Description of env
 *
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Jonas Tomanga
 * @company Logic Plus Information Technologies CC
 */
class Env {

    public static function isDev() {
	return (ENVIRONMENT == 'development' || ENVIRONMENT == 'dev') ? true : false;
    }

    public static function isProd() {
	return (ENVIRONMENT == 'production' || ENVIRONMENT == 'prod') ? true : false;
    }

    public static function setEnv($env) {
	define("ENVIRONMENT", $env);
    }

}
