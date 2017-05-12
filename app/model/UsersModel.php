<?php

/**
 * Description of PortalModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class UsersModel extends ViewModel {

    public function __construct() {
	parent::__construct();
	$this->setDB(new DB());
    }

    public function getUsers() {
	$sql = "SELECT * FROM users";
	try {
	    $this->setContent($this->db->fetchAll($sql), "users");
	} catch (PDOException $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error occured, sorry for the inconvience";
	    $this->setContent($error, "error");
	}
    }

    public function getIntersectionData($int_id) {
	$this->getMainDemand($int_id)
		->getSideDemand($int_id)
		->getIntersectionInfo($int_id)
		->getIntersectionVitals($int_id);
	if (isset($this->content['details']['junction_name'])) {
	    $this->data['pageHeader'] = str_replace("_", " ", $this->content['details']['junction_name']) . " Intersection";
	} else {
	    $this->data['pageHeader'] = "Sflow Intersection";
	}
    }

    private function getMainDemand($int_id) {
	$sql = "SELECT mainTraffic, time FROM TrafficFlow WHERE junction_id = :id";
	try {
	    $this->setContent($this->db->fetchAll($sql, array(":id" => $int_id)), "major");
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch major traffic demand";
	    $this->setContent($error, "main_error");
	}
	return $this;
    }

    private function getSideDemand($int_id) {
	$sql = "SELECT sideTraffic, time FROM TrafficFlow WHERE junction_id = :id";
	try {
	    $this->setContent($this->db->fetchAll($sql, array(":id" => $int_id)), "minor");
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch minor traffic demand";
	    $this->setContent($error, "side_error");
	}

	return $this;
    }

    public function getUserInfo($int_id) {
	$sql = "SELECT * FROM users WHERE user_id = :id";
	try {
	    $this->content = $this->db->fetch($sql, array(":id" => $int_id));
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch user details";
	    $this->setContent($error, "details_error");
	}

	return $this;
    }

    private function getIntersectionVitals($int_id) {
	$sql = "SELECT MAX(mainTraffic) AS main_max, MAX(sideTraffic) AS side_max, MIN(mainTraffic) AS main_min, "
		. "MIN(sideTraffic) AS side_min FROM TrafficFlow WHERE junction_id = :id";
	try {
	    $this->setContent($this->db->fetch($sql, array(":id" => $int_id)), "vitals");
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch intersection details";
	    $this->setContent($error, "vitals_error");
	}
	return $this;
    }

}
