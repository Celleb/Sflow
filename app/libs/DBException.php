<?php

/**
 * Description of DBException
 *
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Jonas Tomanga
 * @company Logic Plus Information Technologies CC
 */
class DBException extends Exception {

    public function __construct($message, $code = 0, Exception $previous = null) {

	parent::__construct($message, $code, $previous);
    }

}
