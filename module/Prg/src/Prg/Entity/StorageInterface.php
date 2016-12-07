<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Entity;


interface StorageInterface {
    /**
    * Get id.
    *
    * @return int
    */
    public function getId();
    /**
    * Set id.
    *
    * @param int $id
    *
    * @return void
    */
    public function setId($id);
    /**
    * Get name.
    *
    * @return string
    */
    public function getName();
    /**
    * Set name.
    *
    * @param string $name
    *
    * @return void
    */
    public function setName($name);
    /**
    * Get path.
    *
    * @return string
    */
    public function getPath();
    /**
    * Set path.
    *
    * @param string $path
    *
    * @return void
    */
    public function setPath($path);
    /**
    * Get credential.
    *
    * @return string
    */
    public function getCredential();
    /**
    * Set credential.
    *
    * @param string $credential
    *
    * @return void
    */
    public function setCredential($credential);
    /**
    * Get size.
    *
    * @return int
    */
    public function getSize();
    /**
    * Set size.
    *
    * @param int $size
    *
    * @return void
    */
    public function setSize($size);
    /**
    * Get downloaded.
    *
    * @return int
    */
    public function getDownloaded();
    /**
    * Set downloaded.
    *
    * @param int $downloaded
    *
    * @return void
    */
    public function setDownloaded($downloaded);
    /**
    * Get time stamp.
    *
    * @return int
    */
    public function getTimeStamp();
    /**
    * Set time stamp.
    *
    * @param datetime $time_stamp
    *
    * @return void
    */
    public function setTimeStamp($time_stamp);
    /**
    * Get remote address.
    *
    * @return string
    */
    public function getRemoteAddr();
    /**
    * Set remote address.
    *
    * @param string $remote_addr
    *
    * @return void
    */
    public function setRemoteAddr($remote_addr);
}