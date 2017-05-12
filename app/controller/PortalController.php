<?php

class PortalController extends Controller {

    /**
     * @override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	if (Session::check()) {
	    $this->model->setTemplate("portal.twig");
	    $meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	    $this->model->setMetaData($meta_data);
	    $data = array('pageHeader' => 'Sflow Portal');
	    $this->model->setData($data);
	    $this->model->getOverview();
	} else {
	    Session::redirect();
	}
    }

}
