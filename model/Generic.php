<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Jean-Mi
 * Date: 21/04/13
 * Time: 11:43
 * To change this template use File | Settings | File Templates.
 */

namespace model;


class Generic {

    private $generatedFilesFolder;
    private $maxSizeFile;

    /**
     *
     */
    public function __construct() {
        $this->generatedFilesFolder = '/static/generatedFiles/';
        $this->maxSizeFile = 1048576; // 1Mo;
    }

    /**
     * Set folder with data files
     * @param $generatedFilesFolder
     */
    public function setGeneratedFilesFolder($generatedFilesFolder)
    {
        $this->generatedFilesFolder = $generatedFilesFolder;
    }

    /**
     * Get folder with data files
     * @return string
     */
    public function getGeneratedFilesFolder()
    {
        return  __DIR__ . '/..' . $this->generatedFilesFolder;
    }

    /**
     * Set max size file upload
     * @param $maxSizeFile
     */
    public function setMaxSizeFile($maxSizeFile)
    {
        $this->maxSizeFile = $maxSizeFile;
    }

    /**
     * Get max size file upload
     * @return int
     */
    public function getMaxSizeFile()
    {
        return $this->maxSizeFile;
    }

    /**
     * Add 1 to the number of times $function has been used for statistics purpose
     * @param $function
     */
    public function increaseUsage($function) {
        $statFolder = self::getGeneratedFilesFolder() . '/stat/';
        $fichier = $statFolder . $function . '.stat';
        if(!file_exists($statFolder))
        {
            mkdir($statFolder,0755);
        }
        if(!file_exists($fichier))
        {
            $fp=fopen($fichier,"w");
            fputs($fp,"0");
            fclose($fp);
        }
        $fp=fopen($fichier,"r+");
        $nb=fgets($fp);
        $nb++;
        fseek($fp,0);
        fputs($fp,$nb);
        fclose($fp);
    }
}