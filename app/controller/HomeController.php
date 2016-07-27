<?php

/**
 * Class Home
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */
class HomeController extends Controller {

    /**
     * @override
     * @param type $model
     * @param type $lang
     */
    public function __construct($model) {
	parent::__construct($model);
	$this->model->setTemplate("home.twig");
	$meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	$this->model->setMetaData($meta_data);
	$data = array('pageHeader' => 'Welcome to Sflow Traffic Light System');
	$this->model->setData($data);
    }

}
