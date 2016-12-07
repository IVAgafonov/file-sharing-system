<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Strategy;


interface DownloadStrategyInterface
{
    /**
     * Download file from server.
     *
     * @param  string $fullPath
     * @return responce
     */
    public function downloadFile($fullPath);
}