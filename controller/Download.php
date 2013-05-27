<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */

namespace controller;


use model\Conversion;

class Download extends Generic {
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
    public function indexAction($parametres) {
        $name = $parametres["name"];
        $conversion = new Conversion();
        $filename = "";
        foreach ($conversion->getGeneratedFiles() as $generatedFile) {
            if (Helper::wd_remove_accents($generatedFile["name"]) == $name) {
                $filename = $generatedFile["filename"];
            }
        }
        $filename = $conversion->getGeneratedFilesFolder() . $filename;
        try {
            $conversion->increaseUsage("telechargementPlanning" . $name);
        } catch (\Exception $e) {

        }
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Length: ' . filesize($filename));
        header('Content-Disposition: inline; filename="' . $name . '.ics"');
        //header('Content-Disposition: attachment inline; filename="calendar.ics"');
        print file_get_contents($filename);
    }
}