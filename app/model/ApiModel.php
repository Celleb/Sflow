<?php

/**
 * Description of PortalModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class ApiModel extends Model {

    public function __construct() {
	parent::__construct();
	$this->db = new DB();
    }

    public function updateTraffic() {
	if (!empty($this->info)) {
	    $sql = "INSERT INTO TrafficFlow "
		    . "(junction_id, sideTraffic, mainTraffic, phase) "
		    . "VALUES(:jid, :side, :main, :phase)";
	    $params[':jid'] = $this->info['junction_id'];
	    $params[':side'] = $this->info['side'];
	    $params[':main'] = $this->info['main'];
	    $params[':phase'] = $this->info['phase'];
	    try {
		$this->db->execute($sql, $params);
	    } catch (Exception $e) {
		echo "db failure " . $e->getMessage();
	    }
	}
    }

    public function updateLog() {
	if (!empty($this->info)) {
	    $sql = "INSERT INTO JunctionLog (junction_id, status) VALUES(:jid, :status)";
	    $params[':jid'] = $this->info['junction_id'];
	    $params[':status'] = $this->info['status'];
	    try {
		$this->db->execute($sql, $params);
	    } catch (Exception $e) {
		echo "db failure" . $e->getMessage();
	    }
	}
    }

}
