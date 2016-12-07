<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Strategy;

use Zend\Http\Response;
use Zend\Http\Headers;

class XSFDownloadStrategy implements DownloadStrategyInterface
{
    /**
     * Download file from server (apache X-SendFile).
     *
     * @param  string $fullPath
     * @return responce
     */
    public function downloadFile($fullPath){
        $response = new Response();
        $headers = new Headers();
        $headers->addHeaderLine('X-Sendfile', $fullPath)
            ->addHeaderLine('Content-Type', 'application/octet-stream')
            ->addHeaderLine('Content-Disposition', 'attachment; filename="'.basename($fullPath).'"')
            ->addHeaderLine('Content-Transfer-Encoding', 'binary')
            ->addHeaderLine('Content-Length', filesize($fullPath))
            ->addHeaderLine('Cache-Control', 'must-revalidate')
            ->addHeaderLine('Pragma', 'public');
        $response->setHeaders($headers);
        return $response;
    }
}

