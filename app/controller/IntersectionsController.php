<?php

class IntersectionsController extends Controller {

    /**
     * @override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	if (Session::check()) {
	    $this->model->setTemplate("intersections.twig");
	    $meta_data = array('title' => 'Home', 'description' => '', 'keywords' => '', 'lang' => 'en');

	    $this->model->setMetaData($meta_data);
	    $data = array('pageHeader' => 'Sflow Intersections');
	    $this->model->setData($data);
	    $this->model->getIntersections();
	    //$this->model->getOverview();
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
	$this->model->setTemplate("intersectionAdd.twig");
	$this->model->setData('Add new intersection', 'pageHeader');
    }

    public function edit($int_id) {
	$this->model->setTemplate("intersectionEdit.twig");
	if ($int_id) {
	    $this->model->setData('Edit Intersection', 'pageHeader');
	    $this->model->getIntersectionInfo($int_id);
	} else {
	    $this->model->setContent("No Intersection id provided", "error");
	}
    }

}
