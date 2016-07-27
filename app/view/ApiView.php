<?php

/**
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class ApiView extends View implements ViewInterface {

    /**
     * @Override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
    }

    /**
     * @override
     */
    public function Output() {

    }

}
