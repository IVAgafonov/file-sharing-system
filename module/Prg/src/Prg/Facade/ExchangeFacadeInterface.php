<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Facade;


interface ExchangeFacadeInterface
{
    /**
     * Upload file.
     *
     * @param  array $request
     * @return array
     */
    public function uploadFile($request);
    /**
     * Download file.
     *
     * @param  string $path
     * @return Response
     */
    public function downloadFile($path);
    /**
     * Get file info by path.
     *
     * @param  string $path
     * @return int
     */
    public function getFileInfo($path);
    /**
     * Check password before download.
     *
     * @param  string $credential
     * @param  string $path
     * @return int
     */
    public function auth($credential, $path);
    /**
     * Get storage list.
     *
     * @param  int $id
     * @return Paginator
     */
    public function getStorageList($page, $filter);
    /**
     * Delete file & path from storage & record from base.
     *
     * @param  int $id
     * @return void
     */
    public function deleteStorage($id);
}