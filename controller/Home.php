<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */

namespace controller;


class Home extends Generic {
	public $view;

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Home Action
     */
    public function indexAction() {
        $view = "home";
        $params = array();
        $scripts = array('formulaire');
        $params['scripts'] = $scripts;
        $model = new \model\Generic();
        $params['maxsize'] = $model->getMaxSizeFile();
        self::getLayout($view, $params);
    }
}