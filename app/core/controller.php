<?php

class Controller {

    /**
     * @var null Model
     */
    public $model = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct($model) {
	$this->model = $model;
	Session::start();
    }

    public function getAction() {
	if (isset($_GET['url'])) {
	    // split URL
	    $url = trim($_GET['url'], '/');
	    $url = filter_var($url, FILTER_SANITIZE_URL);
	    $url = explode('/', $url);
	    return isset($url[1]) ? $url[1] : null;
	} else {
	    return null;
	}
    }

}
