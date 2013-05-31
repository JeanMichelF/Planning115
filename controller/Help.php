<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 31/05/13
 * Time: 18:19
 * To change this template use File | Settings | File Templates.
 */

namespace controller;


class Help extends Generic {
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
        $view = "help";
        $params = array();
        $css = array('help');
        $params['css'] = $css;
        self::getLayout($view, $params);
    }

}