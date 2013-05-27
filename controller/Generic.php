<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 21/04/13
 * Time: 11:43
 * To change this template use File | Settings | File Templates.
 */

namespace controller;


class Generic {

    /**
     *
     */
    public function __construct() {

    }

    /**
     * Return the desired layout for the $view with the $params
     * @param null $view
     * @param array $params
     */
    public function getLayout($view = null, array $params=array()) {
        // Valeurs par défaut
        if (!array_key_exists('includeFooter', $params)) {
            $params['includeFooter'] = true;
        }

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                array_walk_recursive($value, function ($string) {
                    return htmlspecialchars($string);
                });
            } else {
                $value = htmlspecialchars($value);
            }
            $$key = $value;
        }
        include_once sprintf('%s/../layout/%s.php', __DIR__, 'layout');
    }
}