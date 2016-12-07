<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Strategy;

use Zend\Http\Response\Stream;
use Zend\Http\Headers;

class PHPDownloadStrategy implements DownloadStrategyInterface
{
    /**
     * Download file from server (PHP).
     *
     * @param  string $fullPath
     * @return responce
     */
    public function downloadFile($fullPath){
        $response = new Stream();
        $response->setStream(fopen($fullPath, 'r'));
        $response->setStatusCode(200);
        $response->setStreamName(basename($fullPath));
        $response->setContentLength(filesize($fullPath));
        $headers = new Headers();
        $headers->addHeaderLine('Content-Type', 'application/octet-stream')
            ->addHeaderLine('Content-Disposition', 'attachment; filename="'.basename($fullPath).'"')
            ->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Length', filesize($fullPath))
            ->addHeaderLine('Cache-Control', 'must-revalidate')
            ->addHeaderLine('Pragma', 'public');
        $response->setHeaders($headers);
        return $response;
    }
}

