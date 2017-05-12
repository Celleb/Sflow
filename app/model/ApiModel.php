<?php

/**
 * Description of ApiModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class ApiModel extends Model {

    private $output;

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

    public function updateStatus() {
	if (!empty($this->info)) {
	    $sql = "INSERT INTO TrafficJunctionStatus (junction_id, status) VALUES(:jid, :status)";
	    $params[':jid'] = $this->info['junction_id'];
	    $params[':status'] = $this->info['status'];
	    try {
		$this->db->execute($sql, $params);
	    } catch (Exception $e) {
		echo "db failure" . $e->getMessage();
	    }
	}
    }

    private function validate() {
	foreach ($this->info as $key => $info) {
	    if (empty($info) && ($key != "password" && $key != "password2")) {
		return false;
	    }
	}
	return true;
    }

    public function addIntersection() {
	if ($this->validate()) {
	    try {
		$params = array(
		    ":name" => $this->info['majorStreet'] . " - " . $this->info['minorStreet'],
		    ":main" => $this->info['majorStreet'],
		    ":side" => $this->info['minorStreet'],
		    ":lat" => $this->info['latitude'],
		    ":lond" => $this->info['longitude'],
		    ":phases" => $this->info['phases'],
		    ":ways" => $this->info['ways']
		);
		$sql = "INSERT INTO TrafficJunction (junction_name, main_street, side_street, Lat, Lond, phases, ways) "
			. "VALUES(:name, :main, :side, :lat, :lond, :phases, :ways)";
		if ($this->db->execute($sql, $params)) {
		    $sql = "SELECT junction_id FROM TrafficJunction ORDER BY date_added DESC LIMIT 1";
		    $this->results = $this->db->fetch($sql);
		    $this->output = array("code" => 1, "intID" => $this->results['junction_id']);
		} else {
		    $this->output = array("code" => 02, "msg" => "Insert problems");
		}
	    } catch (Exception $e) {
		$this->db_error = $e->getMessage();
		$this->output = array("code" => 00, "msg" => $this->db_error);
	    }
	} else {
	    $this->output = array("code" => 01, "msg" => "Invalid information submitted");
	}
    }

    public function editIntersection($int_id) {
	if ($this->validate()) {
	    try {
		$params = array(
		    ":name" => $this->info['majorStreet'] . " - " . $this->info['minorStreet'],
		    ":main" => $this->info['majorStreet'],
		    ":side" => $this->info['minorStreet'],
		    ":lat" => $this->info['latitude'],
		    ":lond" => $this->info['longitude'],
		    ":phases" => $this->info['phases'],
		    ":ways" => $this->info['ways'],
		    ":id" => $int_id
		);
		$sql = "UPDATE TrafficJunction SET junction_name = :name, main_street = :main, "
			. "side_street = :side, Lat = :lat, Lond = :lond, phases = :phases, ways = :ways "
			. "WHERE junction_id = :id";
		$this->db->execute($sql, $params);
		$this->output = array("code" => 1, "msg" => "Intersection Updated");
	    } catch (Exception $e) {
		$this->db_error = $e->getMessage();
		$this->output = array("code" => 00, "msg" => $this->db_error);
	    }
	} else {
	    $this->output = array("code" => 01, "msg" => "Invalid information submitted");
	}
    }

    public function editUser($user_id) {
	if ($this->validate()) {
	    try {
		$params = array(
		    ":uname" => $this->info['username'],
		    ":fname" => $this->info['fname'],
		    ":sname" => $this->info['sname'],
		    ":id" => $user_id
		);
		$sql = "UPDATE users SET user_name = :uname, Name = :fname, Surname = :sname ";
		if (!empty($this->info['password'])) {
		    $params[':pass'] = $this->info['password'];
		    $sql .= ", password = SHA1(:pass) ";
		}
		$sql .= " WHERE user_id = :id";
		$this->db->execute($sql, $params);
		$this->output = array("code" => 1, "msg" => "User update successful");
	    } catch (Exception $e) {
		$this->db_error = $e->getMessage();
		$this->output = array("code" => 00, "msg" => $this->db_error);
	    }
	} else {
	    $this->output = array("code" => 4, "msg" => "Invalid information submitted");
	}
    }

    public function addUser() {
	if ($this->validate() && !empty($this->info['password'])) {
	    try {
		$params = array(
		    ":uname" => $this->info['username'],
		    ":fname" => $this->info['fname'],
		    ":sname" => $this->info['sname'],
		    ":pass" => $this->info['password']
		);
		$sql = "INSERT INTO users (user_name, Name, Surname, password) VALUES(:uname, :fname, :sname, SHA1(:pass))";
		$this->db->execute($sql, $params);
		$this->output = array("code" => 1, "msg" => "User creation successful");
	    } catch (Exception $e) {
		$this->db_error = $e->getMessage();
		$this->output = array("code" => 00, "msg" => $this->db_error);
	    }
	} else {
	    $this->output = array("code" => 4, "msg" => "Invalid information submitted");
	}
    }

    public function addAccident() {
	if ($this->validate()) {
	    try {
		$params = array(
		    ":street" => $this->info['street'],
		    ":lat" => $this->info['latitude'],
		    ":lond" => $this->info['longitude'],
		    ":desc" => $this->info['description']
		);
		$sql = "INSERT INTO Traffic_Accidents (Street, location_lat, location_long, Description) VALUES(:street, :lat, :lond, :desc)";
		$this->db->execute($sql, $params);
		$this->output = array("code" => 1, "msg" => "Accident report successful");
	    } catch (Exception $e) {
		$this->db_error = $e->getMessage();
		$this->output = array("code" => 00, "msg" => $this->db_error);
	    }
	} else {
	    $this->output = array("code" => 4, "msg" => "Invalid information submitted");
	}
    }

    public function removeIntersection($int_id) {
	try {
	    $sql = "DELETE FROM TrafficJunction WHERE junction_id = ?";
	    $this->db->execute($sql, array($int_id));
	    $this->output = array("code" => 1, "msg" => "Intersection Deleted");
	} catch (Exception $e) {
	    $this->db_error = $e->getMessage();
	    $this->output = array("code" => 00, "msg" => $this->db_error);
	}
    }

    public function removeUser($user_id) {
	try {
	    $sql = "DELETE FROM users WHERE user_id = ?";
	    $this->db->execute($sql, array($user_id));
	    $this->output = array("code" => 1, "msg" => "User Deleted");
	} catch (Exception $e) {
	    $this->db_error = $e->getMessage();
	    $this->output = array("code" => 00, "msg" => $this->db_error);
	}
    }

    public function setOutput($data) {
	$this->output = $data;
    }

    public function getOutput() {
	return $this->output;
    }

    public function getIntersections() {
	try {
	    $sql = "SELECT tr.*"
		    . ", (SELECT junction_status FROM TrafficJunctionStatus AS ts WHERE  (UNIX_TIMESTAMP()-300) <= UNIX_TIMESTAMP(ts.time) && ts.junction_id = tr.junction_id) as status "
		    . " FROM TrafficJunction AS tr";
	    $this->results = $this->db->fetchAll($sql);
	    $this->output = array("code" => 1, "intersections" => $this->results);
	} catch (Exception $e) {
	    $this->db_error = $e->getMessage();
	    $this->output = array("code" => 0, "msg" => $this->db_error);
	}
    }

    public function getDemand() {
	//$sql = "SELECT id, (6371 * acos(cos(radians(37))*cos(radians(lat))*cos(radians(lng)-radians(-122))+sin(radians(37))*sin(radians(lat)))) AS distance FROM markers HAVING distance < 25 ORDER BY distance LIMIT 0,20";

	try {
	    $sql = "SELECT tr.*"
		    . ", (SELECT mainTraffic FROM TrafficFlow AS ts WHERE  (UNIX_TIMESTAMP()-300) <= UNIX_TIMESTAMP(ts.time) && ts.junction_id = tr.junction_id) as major "
		    . ", (SELECT sideTraffic FROM TrafficFlow AS ts WHERE  (UNIX_TIMESTAMP()-300) <= UNIX_TIMESTAMP(ts.time) && ts.junction_id = tr.junction_id) as minor "
		    . " FROM TrafficJunction AS tr";
	    $this->results = $this->db->fetchAll($sql);
	    $this->output = array("code" => 1, "intersections" => $this->results);
	} catch (Exception $e) {
	    $this->db_error = $e->getMessage();
	    $this->output = array("code" => 0, "msg" => $this->db_error);
	}
    }

    /**
     *
     */
}
