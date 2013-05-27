<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 27/05/13
 * Time: 19:51
 * To change this template use File | Settings | File Templates.
 */

namespace controller;


class Helper {

    /**
     * @param string $str
     * @param string $charset
     * @return string
     */
    public static function wd_remove_accents($str, $charset='utf-8')
    {
        $str = htmlentities($str, ENT_NOQUOTES, $charset);

        $str = preg_replace('#&([A-za-z])(?:acute|cedil|circ|grave|orn|ring|slash|th|tilde|uml);#', '\1', $str);
        $str = preg_replace('#&([A-za-z]{2})(?:lig);#', '\1', $str); // pour les ligatures e.g. '&oelig;'
        $str = preg_replace('#&[^;]+;#', '', $str); // supprime les autres caractères

        return $str;
    }
}