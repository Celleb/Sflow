<?php

/**
 * Description of Logger
 *
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Jonas Tomanga
 * @company Logic Plus Information Technologies CC
 */
class Logger {

//put your code here
    protected $file;
    protected $log;

    public function __construct($log = "log.txt") {
	try {
	    $this->log = $log;
	    $this->file = fopen($log, "w");
	} catch (Exception $e) {
	    echo "cant open file" . $e->getMessage();
	    throw new LoggerException("Cant open file", 1);
	}
    }

    public function write($content, $close = true) {
	try {
	    fwrite($this->file, $content);
	    $close ? fclose($this->file) : null;
	    return $this;
	} catch (Exception $e) {
	    echo "can't write to file" . $e->getMessage();
	    throw new LoggerException("Can't write to file", 2);
	}
    }

    public function close() {
	try {
	    fclose($this->file);
	} catch (Exception $e) {
	    throw new LoggerException("Can't close file", 3);
	}
    }

    public function open() {
	try {
	    fopen($this->log, "w");
	    return $this;
	} catch (Exception $e) {
	    throw new LoggerException("Can't open file", 4);
	}
    }

}
