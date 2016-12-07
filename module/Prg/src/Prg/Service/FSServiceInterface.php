<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Service;


interface FSServiceInterface
{
    /**
     * Generate new path name.
     *
     * @param  void
     * @return string
     */
    public function getNewPath();
    /**
     * Get full file name.
     *
     * @param string $path
     * @param string $filename
     * @return string
     */
    public function getFullPath($path, $filename);
    /**
     * Create new path.
     *
     * @param  string $path
     * @return int
     */
    public function createPath($path);
    /**
     * Delete path.
     *
     * @param  string $path
     * @return bool
     */
    public function deletePath($path);
    /**
     * Transfer downloaded file to path.
     *
     * @param  string $from
     * @param  string $path
     * @param  string $filename
     * @return int
     */
    public function moveToPath($from, $path, $filename);
    /**
     * Delete file from path.
     *
     * @param  string $path
     * @param  string $filename
     * @return int
     */
    public function deleteFromPath($path, $filename);
}

