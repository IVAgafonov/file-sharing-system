<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Service;


class FSService implements FSServiceInterface
{
    protected $storageDir;
    protected $pathContent;
    protected $pathLength;
    
    public function __construct($config)
    {
        $this->pathContent = $config['path-content'];
        $this->pathLength = $config['path-length'];
        $this->storageDir = $config['prg-storage-dir'];
    }
    /**
     * Generate new path name.
     *
     * @param  void
     * @return string
     */
    public function getNewPath()
    {
        $newPath = "";
        for ($i = 0; $i < $this->pathLength; $i++) {
            $newPath .= $this->pathContent[rand(0, strlen($this->pathContent) - 1)];
        }
        return $newPath;
    }
    /**
     * Get full file name.
     *
     * @param string $path
     * @param string $filename
     * @return string
     */
    public function getFullPath($path, $filename)
    {
        $fullPath = $this->storageDir.$path."/".$filename;
        return $fullPath;
    }
    /**
     * Create new path.
     *
     * @param  string $path
     * @return bool
     */
    public function createPath($path)
    {
        return mkdir($this->storageDir.$path."/");
    }
    /**
     * Delete path.
     *
     * @param  string $path
     * @return bool
     */
    public function deletePath($path)
    {
        return rmdir($this->storageDir.$path);
    }
    /**
     * Transfer downloaded file to path.
     *
     * @param  string $from
     * @param  string $path
     * @param  string $filename
     * @return int
     */
    public function moveToPath($from, $path, $filename)
    {
        if (!copy($from, $this->storageDir.$path."/".$filename)) {
            $this->deleteFromPath($path);
            return 0;
        }
        return 1;
    }
    /**
     * Delete file from path.
     *
     * @param  string $path
     * @param  string $filename
     * @return int
     */
    public function deleteFromPath($path, $filename)
    {
        unlink($this->storageDir.$path."/".$filename);
        $this->deletePath($path);
        return 1;
    }
}

