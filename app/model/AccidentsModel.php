<?php

/**
 * Description of PortalModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class AccidentsModel extends ViewModel {

    public function __construct() {
	parent::__construct();
	$this->setDB(new DB());
    }

    public function getAccidents() {
	$sql = "SELECT * FROM Traffic_Accidents";
	try {
	    $this->setContent($this->db->fetchAll($sql), "accidents");
	} catch (PDOException $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error occured, sorry for the inconvience";
	    $this->setContent($error, "error");
	}
    }

    public function getAccidentInfo($acc_id) {
	$sql = "SELECT * FROM Traffic_Accidents WHERE record_id = :id";
	try {
	    $this->content = $this->db->fetch($sql, array(":id" => $acc_id));
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch accident details";
	    $this->setContent($error, "error");
	}

	return $this;
    }

}
