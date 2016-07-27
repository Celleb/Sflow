<?php

/**
 * Description of PortalView
 *
 * @author Jonas Tomanga <celleb@mrcelleb.com>
 */
class PortalView extends View implements ViewInterface {

    private $twig;

    /**
     * @Override
     * @param type $model
     */
    public function __construct($model) {
	parent::__construct($model);
	$loader = new Twig_Loader_Filesystem(APP . 'view/_tpl');
	$this->twig = new Twig_Environment($loader);
	$this->twig = $this->twig->loadTemplate($this->model->getTemplate());
    }

    /**
     * @override
     */
    public function Output() {
	$this->twig->display(array('meta' => $this->model->getMetaData(),
	    'content' => $this->model->getContent(),
	    'data' => $this->model->getData(),
	    'session' => Session::getUserInfo()
		)
	);
    }

}
