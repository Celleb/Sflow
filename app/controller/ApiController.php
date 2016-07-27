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

}
