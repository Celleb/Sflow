<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Accomodation
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class ToursController extends Controller {

    /**
     * @override
     * @param type $model
     * @param type $lang
     */
    public function __construct($model) {
	parent::__construct($model);
	$this->model->setTemplate("tours.twig");
	$meta_en = array('title' => 'Tours', 'description' => '', 'keywords' => '', 'lang' => 'en');
	$meta_de = array('title' => 'Touren', 'description' => '', 'keywords' => '', 'lang' => 'de');
	$meta_data = array('en' => $meta_en, 'de' => $meta_de);
	$this->model->setMetaData($meta_data[$lang]);
	$this->model->setLangUrl(ToolBox::langUrl($lang));
	$data_en = array('pageHeader' => 'Tours');
	$data_de = array('pageHeader' => 'Touren');
	$data = array('en' => $data_en, 'de' => $data_de);
	$this->model->setData(array_merge($data[$lang], array('page' => 'Tours')));
    }

    public function selfDrive($params = '') {
	$meta_en = array('title' => 'Self Drive Tours', 'description' => '', 'keywords' => '', 'lang' => 'en');
	$meta_de = array('title' => 'Selbstfahrer Touren', 'description' => '', 'keywords' => '', 'lang' => 'de');
	$meta_data = array('en' => $meta_en, 'de' => $meta_de);
	$this->model->setMetaData($meta_data[$this->model->lang]);
	$this->model->setLangUrl(ToolBox::langUrl($this->model->lang));
	$data_en = array('pageHeader' => 'Self Drive Tours');
	$data_de = array('pageHeader' => 'Selbstfahrer Touren');
	$data = array('en' => $data_en, 'de' => $data_de);
	require_once 'data/selfdrivetours.php';
	$this->model->setContent($selfdrive_tours[$this->model->lang]);
	$this->model->setData(array_merge($data[$this->model->lang], array('page' => 'SelfDrive')));

	//$this->model->index($params);
    }

    public function guidedTours($params = '') {
	$meta_en = array('title' => 'Guided Tours', 'description' => '', 'keywords' => '', 'lang' => 'en');
	$meta_de = array('title' => 'Geführte Touren', 'description' => '', 'keywords' => '', 'lang' => 'de');
	$meta_data = array('en' => $meta_en, 'de' => $meta_de);
	$this->model->setMetaData($meta_data[$this->model->lang]);
	$this->model->setLangUrl(ToolBox::langUrl($this->model->lang));
	$data_en = array('pageHeader' => 'Guided Tours');
	$data_de = array('pageHeader' => 'Geführte Touren');
	$data = array('en' => $data_en, 'de' => $data_de);
	require_once 'data/guidedtours.php';
	$this->model->setContent($guided_tours[$this->model->lang]);
	$this->model->setData(array_merge($data[$this->model->lang], array('page' => 'GuidedTours')));

	//$this->model->index($params);
    }

}
