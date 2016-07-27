<?php

class AuthController extends Controller {

    /**
     * @override
     * @param type $model
     * @param type $lang
     */
    public function __construct($model) {
	parent::__construct($model);
	if (Session::check() && $this->getAction() !== "logout") {
	    header("location: ../portal");
	} else {
	    $this->model->setTemplate("auth.twig");
	    $meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	    $this->model->setMetaData($meta_data);
	    $data = array('pageHeader' => 'Welcome to Sflow Traffic Light System');
	    $this->model->setData($data);
	}
    }

    public function login() {
	$this->model->setInfo($_POST);
	$this->model->login();
    }

    public function logout() {
	Session::destroy();
	$this->model->setContent("You have been logged out", "error");
    }

}
