<?php

/**
 * Base class for the View
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class View {

//put your code here
    public $model;

    public function __construct(Model $model) {
	$this->model = $model;
    }

}
