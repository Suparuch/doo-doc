<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of log
 *
 * @author Sorn
 */
class log {

    private $path;

    public function setpath($LOG_PATH, $logname) {
        $this->path = $LOG_PATH . $logname;
    }

    public function writelog($txt) {
        $objFopen = @fopen($this->path, 'a');
        @fwrite($objFopen, $txt);
        @fclose($objFopen);
    }

    public function checkpath($curpath, $logpath) {
        $LOG_PATH = '';

        $base_curpath = str_replace('\\', '/', $curpath);

        $LOG_PATH = $base_curpath . $logpath;

        /*         * **** check file exist ***** */
        if (!is_dir($LOG_PATH)) {
            $create = mkdir($LOG_PATH, 0777);
            if (!$create) {
                echo 'cannot create log path !!';
            }
        }

        return $LOG_PATH;
    }

}

?>