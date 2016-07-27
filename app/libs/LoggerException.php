<?php

/**
 * Description of LoggerException
 *
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Jonas Tomanga
 * @company Logic Plus Information Technologies CC
 */
class LoggerException extends Exception {

//put your code here
    public function __construct($message, $code = 0, Exception $previous = null) {

	parent::__construct($message, $code, $previous);
    }

}
