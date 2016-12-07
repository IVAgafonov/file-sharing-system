<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Service\System;


interface LoggerServiceInterface
{
    /**
     * Log srt to file.
     *
     * @param  string $str
     * @return void
     */
    public function log($str);
}