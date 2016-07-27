<?php

/**
 * Provides and interface to call the PDO
 * @author Jonas Tomanga <celleb@logicpp.com.na>
 * @copyright (c) 2016, Logic Plus Information Technologies CC
 * @version 3.1.0
 */
class DB {

    /**
     * Holds the PDO statement object
     * @var object
     * @since version 2.1.0
     */
    protected $stmt;
    protected $conn = null;
    protected $error = null;

    /**
     * Creates an object to statically use pdo
     * @param string $user The Database Username
     * @param string $pass The Database password of the given user
     * @return \PDO Returns PHP Database Object
     * @since version 1.0
     */
    public function __construct() {
	try {
	    $data = DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME;
	    $this->conn = new PDO($data, DB_USER, DB_PASS);
	    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    return $this;
	} catch (PDOException $e) {
	    // $this->error = "Could not connect to database";
	    // echo $e->getMessage();
	    throw new DBException($e->getMessage(), 1);
	}
    }

    /**
     * Prepares a statement and executes the statement using the given query and parameters
     * @param string $sql A string of the sql query
     * @param array $params An array of the parameter
     * @todo Add proper exception handling
     * @since version 2.0
     */
    public function execute($sql, $params = array()) {
	/* clear stmt */
	$this->stmt = "";
	try {
	    $this->stmt = $this->conn->prepare($sql);
	    $this->stmt->execute($params);
	    return $this;
	} catch (PDOException $e) {

	    throw new DBException($e->getMessage(), 1);
	}
    }

    /**
     * Fetches the results of the executed statement
     * @param string $sql A string of the sql query
     * @param array $params An array of the parameter
     * @param int $method The code for the fetch Method to be used, defaulst to FETCH_ASSOC
     * @return array Returns an array of rows from the database
     * @since version 2.0
     */
    public function fetchAll($sql, $params = array(), $method = PDO::FETCH_ASSOC) {
	try {
	    return $this->execute($sql, $params) ? $this->stmt->fetchAll($method) : false;
	} catch (PDOException $e) {
	    $this->error = "Could Not Execute Query";
	    // echo $e->getMessage();
	    throw new DBException($e->getMessage(), 1);
	}
    }

    /**
     * Fetch the result of the executed statement
     * @param string $sql A string of the sql query
     * @param array $params An array of the parameter
     * @param int $method Fetch Method
     * @return array Returns an array of one from the database
     * @since version 2.0
     */
    public function fetch($sql, $params = array(), $method = PDO::FETCH_ASSOC) {
	try {
	    return $this->execute($sql, $params) ? $this->stmt->fetch($method) : false;
	} catch (PDOException $e) {
	    //echo $e->getMessage();
	    throw new DBException($e->getMessage(), 1);
	}
    }

    /* additions 3.0 */

    /**
     * Execute Method with BindParams
     * @param string $sql sql string
     * @param array $params an array of parameters array(array(key ='', type = '', value =''));
     * @return bool Return true if sql executes successfully or false on failure
     * @since version 3.0
     */
    public function executeWithParams($sql, $params = array()) {
	$this->stmt = "";
	try {
	    $this->stmt = $this->conn->prepare($sql);
	    foreach ($params as $key => $value) {
		$key = is_numeric($key) ? $key + 1 : $key;
		$this->stmt->bindParam($key, $value['data'], $value['type']);
	    }
	    return $this->stmt->execute() ? true : false;
	} catch (PDOException $e) {
	    throw new DBException($e->getMessage(), 1);
	}
    }

    /**
     * Fetch the result of the executed statement with Params
     * @param string $sql A string of the sql query
     * @param array $params An array of the parameter
     * @param int $method Fetch Method
     * @return array Returns an array of one from the database
     * @since version 3.0
     */
    public function fetchWithParams($sql, $params = array(), $method = PDO::FETCH_ASSOC) {
	try {
	    return $this->executeWithParams($sql, $params) ? $this->stmt->fetch($method) : false;
	} catch (PDOException $e) {
	    throw new DBException($e->getMessage(), 1);
	}
    }

    /**
     * Fetches the results of the executed statement with BindParams
     * @param string $sql A string of the sql query
     * @param array $params An array of the parameter
     * @param int $method The code for the fetch Method to be used, defaulst to FETCH_ASSOC
     * @return array Returns an array of rows from the database
     * @since version 3.0
     */
    public function fetchAllWithParams($sql, $params = array(), $method = PDO::FETCH_ASSOC) {
	try {
	    return $this->executeWithParams($sql, $params) ? $this->stmt->fetchAll($method) : false;
	} catch (PDOException $e) {
	    throw new DBException($e->getMessage(), 1);
	}
    }

    public function getConn() {
	return $this->conn;
    }

}
