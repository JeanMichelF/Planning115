<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 20/04/13
 * Time: 23:43
 * To change this template use File | Settings | File Templates.
 */

namespace controller;

use \model\Conversion;

class Upload extends Generic {
	public $view;

    /**
     *
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Handle file form
     * @param $parametres
     */
    public function indexAction($parametres) {
        $view = "home";
        $params = array();
        if (isset($parametres['fichier']) && is_array($parametres['fichier'])) {
            $file = $parametres['fichier'];
            if (!isset($file) or $file['error'] > 0) {
                self::loadErrors("Fichier non chargé", $params);
            } else if ($parametres['MAX_FILE_SIZE'] !== FALSE AND $file['size'] > $parametres['MAX_FILE_SIZE']) {
                self::loadErrors("Fichier trop volumineux", $params);
            } else if (filesize($file['tmp_name']) > $parametres['MAX_FILE_SIZE']) {
                self::loadErrors("Fichier trop volumineux", $params);
            } else {
                $filenameexploded = explode('.', $file['name']);
                if (count($filenameexploded) > 1) {
                    $extension = $filenameexploded[1];
                    if (!in_array($extension, array('xls', 'xlsx', 'xlsm', 'ods'))) {
                        self::loadErrors("Extension du fichier non valide", $params);
                    } else {
                        self::handleFile($file, $extension);
                    }
                } else {
                    self::loadErrors("Fichier non valide", $params);
                }
            }
        } else {
            self::loadErrors("Fichier non chargé", $params);
        }
        self::getLayout($view, $params);
    }

    /**
     * Handle errors form form file
     * @param string $message
     * @param $params
     */
    private function loadErrors($message = "", &$params) {
        $scripts = array('formulaire');
        $params['scripts'] = $scripts;
        $model = new \model\Generic();
        $params['maxsize'] = $model->getMaxSizeFile();
        $params['errorMessage'] = $message . '. Veuillez choisir un autre fichier';
    }

    /**
     * Handle the file (everything went well so far)
     * @param $file
     * @param $extension
     */
    private function handleFile($file, $extension) {
        $conversion = new Conversion();
        $newFile = $conversion->getGeneratedFilesFolder().'atraiter.'.$extension;
        //Déplacement
        if (move_uploaded_file($file['tmp_name'],$newFile)) {
            $conversion->convert($newFile);
            try {
                $conversion->increaseUsage("generationPlanning");
            } catch (\Exception $e) {

            }
            header('Location: http://www.bakubakuanimals.net/planning115/upload-complete');
        } else {
            self::loadErrors("Problème lors du traitement du fichier", $params);
        }
    }

    /**
     * Display data processing result
     */
    public function completeAction() {
        $view = "result";
        $params = array();
        $scripts = array('result');
        $params['scripts'] = $scripts;
        $conversion = new Conversion();
        $errorLog = $conversion->getErrorLogs();
        $warningLog = $conversion->getWarningLogs();
        $debugLog = $conversion->getDebugLogs();
        if (strlen($errorLog) > 0) {
            $params['errorMessage'] = $errorLog;
        }
        if (strlen($warningLog) > 0) {
            $params['warningMessage'] = $warningLog;
        }
        if (strlen($debugLog) > 0) {
            $params['debugMessage'] = $debugLog;
        }
        $generatedFiles = array();
        foreach ($conversion->getGeneratedFiles() as $generatedFile) {
            $generatedFiles[] = array("urlName" => Helper::wd_remove_accents($generatedFile["name"]), "name" => $generatedFile["name"]);
        }
        $params['generatedFiles'] = $generatedFiles;
        self::getLayout($view, $params);
    }
}