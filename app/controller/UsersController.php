<?php

class UsersController extends Controller {

    /**
     * @override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	if (Session::check()) {
	    $this->model->setTemplate("users.twig");
	    $meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	    $this->model->setMetaData($meta_data);
	    $data = array('pageHeader' => 'Sflow Users');
	    $this->model->setData($data);
	    $this->model->getUsers();
	} else {
	    Session::redirect();
	}
    }

    public function view($int_id) {
	$this->model->setTemplate("intersectionsView.twig");
	if ($int_id) {
	    $this->model->getIntersectionData($int_id);
	} else {
	    $this->model->setContent("No Intersection id provided", "error");
	}
    }

    public function add() {
	$this->model->setTemplate("userAdd.twig");
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
