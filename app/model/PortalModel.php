<?php

/**
 * Description of PortalModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class PortalModel extends ViewModel {

    public function __construct() {
	parent::__construct();
	$this->setDB(new DB());
    }

    public function getOverview() {
	$sql = "SELECT COUNT(*) as total, "
		. "(SELECT COUNT(*) FROM TrafficJunctionStatus WHERE  (UNIX_TIMESTAMP()-300) <= UNIX_TIMESTAMP(time)) as active_total"
		. " FROM TrafficJunction";
	try {
	    $this->setContent($this->db->fetch($sql), "overview");
	} catch (Exception $e) {
	    $error = Env::isDev() ? "Database error: " . $e->getMessage() : "A database error, could not fetch intersection details";
	    $this->setContent($error, "overview_error");
	}
    }

}
