<?php

class AccidentsController extends Controller {

    /**
     * @override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	if (Session::check()) {
	    $this->model->setTemplate("accidents.twig");
	    $meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	    $this->model->setMetaData($meta_data);
	    $data = array('pageHeader' => 'Sflow Accident Reports');
	    $this->model->setData($data);
	    $this->model->getAccidents();
	} else {
	    Session::redirect();
	}
    }

    public function view($acc_id) {
	$this->model->setTemplate("accidentView.twig");
	if ($acc_id) {
	    $this->model->getAccidentInfo($acc_id);
	} else {
	    $this->model->setContent("No accident id provided", "error");
	}
    }

    public function add() {
	$this->model->setTemplate("accidentAdd.twig");
	$this->model->setData('Add new user', 'pageHeader');
    }

    public function edit($int_id) {
	$this->model->setTemplate("userEdit.twig");
	if ($int_id) {
	    $this->model->setData('Edit User', 'pageHeader');
	    $this->model->getUserInfo($int_id);
	} else {
	    $this->model->setContent("No user id provided", "error");
	}
    }

}
