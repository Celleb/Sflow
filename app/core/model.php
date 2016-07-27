<?php

/**
 * Base class of the model from which all model classes will inherit
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 * @version 1.0.0
 */
class Model {

    protected $db;
    protected $info = null;
    protected $validation_error = null;
    protected $db_error = null;
    protected $results = null;

    /**
     *
     */
    public function __construct() {
	//$this->db = $DB;
    }

    public function setDB(DB $db) {
	$this->db = $db;
    }

    public function getDB() {
	return $this->db;
    }

    public function setInfo($values, $key = false) {
	if ($key) {
	    $this->info[$key] = $values;
	} else {
	    $this->info = $values;
	}
	return $this;
    }

    public function getInfo($key = false) {
	return $key ? $this->info[$key] : $this->info;
    }

    public function getDBerror() {
	return $this->db_error;
    }

    public function getValidationErrors() {
	return $this->validation_error;
    }

    public function getResults($key = null) {
	return is_null($key) ? $this->results : $this->results;
    }

}
