<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Service\System;


class LoggerService implements LoggerServiceInterface
{
    private $path;
    public function __construct($config)
    {
        $this->path = $config['prg-log-path'];
    }
    /**
     * Log str to file.
     *
     * @param  string $str
     * @return void
     */
    public function log($str)
    {
        $date = date("Y-n-j");
        $time = date("H.i.s");
        $fileName = $this->path.$date."_log.log";
        $str = "[$date $time] ".$str."\r\n";
        file_put_contents($fileName, $str, FILE_APPEND);
    }
}