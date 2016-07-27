<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewModel
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class ViewModel extends Model {

//put your code here
    protected $meta_data = '';
    protected $data = '';
    protected $content = '';
    protected $view_template;

    public function setTemplate($template) {
	$this->view_template = $template;
    }

    public function getTemplate() {
	return $this->view_template;
    }

    public function setMetaData($data, $key = '') {
	if (!empty($key)) {
	    $this->meta_data[$key] = $data;
	} else {
	    $this->meta_data = $data;
	}
    }

    public function getMetaData($key = '') {
	return !empty($key) ? $this->data[$key] : $this->data;
    }

    public function setData($data, $key = '') {
	if (!empty($key)) {
	    $this->data[$key] = $data;
	} else {
	    $this->data = $data;
	}
    }

    public function getData($key = '') {

	return !empty($key) ? $this->data[$key] : $this->data;
    }

    public function setContent($content, $key) {
	if (!empty($key)) {
	    $this->content[$key] = $content;
	} else {
	    $this->content = $content;
	}
    }

    public function getContent() {
	return !empty($key) ? $this->content[$key] : $this->content;
    }

}
