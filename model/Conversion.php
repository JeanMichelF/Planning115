<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 16/03/13
 * Time: 13:05
 * To change this template use File | Settings | File Templates.
 */

namespace model;

//Inclusion de la classe de convertion
require_once __DIR__ . '/../lib/PHPPlanningXLS2ICS/classes/JMF/PHPPlanningXLS2ICS/Converter.php';

use \JMF\PHPPlanningXLS2ICS;
class Conversion extends Generic {
    private $debugLog;
    private $infoLog;
    private $warningLog;
    private $errorLog;
    private $generatedFiles;

    /**
     *
     */
    public function __construct() {
        parent::__construct();
        $this->debugLog = 'debug.log';
        $this->infoLog = 'info.log';
        $this->warningLog = 'warning.log';
        $this->errorLog = 'error.log';
        $this->generatedFiles = 'generatedFiles.data';
    }

    /**
     * Convert one file
     * @param $fileInput
     */
    public function convert($fileInput) {
        //création de l'objet
        $converter = new PHPPlanningXLS2ICS\Converter();
        $generatedFiles = $converter->convertFile($fileInput, parent::getGeneratedFilesFolder());
        $fileDebug = new \SplFileObject(parent::getGeneratedFilesFolder() . $this->debugLog, 'w');
        $fileDebug->fwrite($converter->showDebugLogs());
        $fileInfo = new \SplFileObject(parent::getGeneratedFilesFolder() . $this->infoLog, 'w');
        $fileInfo->fwrite($converter->showInfoLogs());
        $fileWarning = new \SplFileObject(parent::getGeneratedFilesFolder() . $this->warningLog, 'w');
        $fileWarning->fwrite($converter->showWarningLogs());
        $fileError = new \SplFileObject(parent::getGeneratedFilesFolder() . $this->errorLog, 'w');
        $fileError->fwrite($converter->showErrorLogs());
        $fileError = new \SplFileObject(parent::getGeneratedFilesFolder() . $this->generatedFiles, 'w');
        $fileError->fwrite(serialize($generatedFiles));
    }

    /**
     * Return an array of array (name, filename) generated
     * @return mixed
     */
    public function getGeneratedFiles()
    {
        return unserialize(file_get_contents(parent::getGeneratedFilesFolder() . $this->generatedFiles));
    }

    /**
     * Return Debug Log
     * @return string
     */
    public function getDebugLogs()
    {
        return file_get_contents(parent::getGeneratedFilesFolder() . $this->debugLog);
    }

    /**
     * Return Info Log
     * @return string
     */
    public function getInfoLogs()
    {
        return file_get_contents(parent::getGeneratedFilesFolder() . $this->infoLog);
    }

    /**
     * Return Warning Log
     * @return string
     */
    public function getWarningLogs()
    {
        return file_get_contents(parent::getGeneratedFilesFolder() . $this->warningLog);
    }

    /**
     * Return Error Log
     * @return string
     */
    public function getErrorLogs()
    {
        return file_get_contents(parent::getGeneratedFilesFolder() . $this->errorLog);
    }
}