<?php

class ApiController extends Controller {

    /**
     * @override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	$this->model->setInfo($_GET);
	$logger = new Logger();
	$logger->write(serialize($_GET) . " " . date("dd mm YY / H:i:s"));
    }

    public function updateTraffic() {
	$this->model->updateTraffic();
    }

    public function updateLog() {
	$this->model->updateLog();
    }

    public function updateStatus() {
	$this->model->updateStatus();
    }

    public function add() {
	$this->model->setInfo($_POST);
	$this->model->addIntersection();
    }

    public function edit($int_id) {
	if (isset($int_id)) {
	    $this->model->setInfo($_POST);
	    $this->model->editIntersection($int_id);
	} else {
	    $this->model->setOutput(array("code" => 003, "msg" => "Intersection id not provided"));
	}
    }

    public function remove($int_id) {
	if (isset($int_id)) {
	    $this->model->setInfo($_POST);
	    $this->model->removeIntersection($int_id);
	} else {
	    $this->model->setOutput(array("code" => 003, "msg" => "Intersection id not provided"));
	}
    }

    public function userremove($user_id) {
	if (isset($user_id)) {
	    $this->model->setInfo($_POST);
	    $this->model->removeUser($user_id);
	} else {
	    $this->model->setOutput(array("code" => 003, "msg" => "User id not provided"));
	}
    }

    public function useradd() {
	$this->model->setInfo($_POST);
	$this->model->addUser();
    }

    public function accadd() {
	$this->model->setInfo($_POST);
	$this->model->addAccident();
    }

    public function useredit($user_id) {
	if (isset($user_id)) {
	    $this->model->setInfo($_POST);
	    $this->model->editUser($user_id);
	} else {
	    $this->model->setOutput(array("code" => 003, "msg" => "User id not provided"));
	}
    }

    public function intersections() {
	$this->model->getIntersections();
    }

    public function demand() {
	$this->model->getDemand();
    }

}
