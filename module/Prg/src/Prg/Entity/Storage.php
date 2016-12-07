<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 *
 * Storage entity
 * 
 * @ORM\Entity
 * @ORM\Table(name="storage", indexes={@ORM\Index(name="path_idx", columns={"path"}), @ORM\Index(name="name_idx", columns={"name"})})
 *
 */
class Storage implements StorageInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column(type="string", name="name", length=100)
     */
    protected $name;
    /**
     * @var string
     * @ORM\Column(type="string", name="path", length=100, unique=true)
     */
    protected $path;
    /**
     * @var string
     * @ORM\Column(type="string", name="credential", length=100, nullable=true)
     */
    protected $credential;
    /**
     * @var int
     * @ORM\Column(type="integer", name="size")
     */
    protected $size;
    /**
     * @var int
     * @ORM\Column(type="integer", name="downloaded")
     */
    protected $downloaded;
    /**
     * @var DateTime
     * @ORM\Column(type="datetime", name="time_stamp")
     */
    protected $time_stamp;
    /**
     * @var string
     * @ORM\Column(type="string", name="remote_addr", length=100)
     */
    protected $remote_addr;
    /**
    * Get id.
    *
    * @return int
    */
    public function getId()
    {
        return $this->id;
    }
    /**
    * Set id.
    *
    * @param int $id
    *
    * @return void
    */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
    * Get name.
    *
    * @return string
    */
    public function getName()
    {
        return $this->name;
    }
    /**
    * Set name.
    *
    * @param string $name
    *
    * @return void
    */
    public function setName($name)
    {
        $this->name = $name;
    }
    /**
    * Get path.
    *
    * @return string
    */
    public function getPath()
    {
        return $this->path;
    }
    /**
    * Set path.
    *
    * @param string $path
    *
    * @return void
    */
    public function setPath($path)
    {
        $this->path = $path;
    }
    /**
    * Get credential.
    *
    * @return string
    */
    public function getCredential()
    {
        return $this->credential;
    }
    /**
    * Set credential.
    *
    * @param string $credential
    *
    * @return void
    */
    public function setCredential($credential)
    {
        $this->credential = $credential;
    }
    /**
    * Get size.
    *
    * @return int
    */
    public function getSize()
    {
        return $this->size;
    }
    /**
    * Set size.
    *
    * @param int $size
    *
    * @return void
    */
    public function setSize($size)
    {
        $this->size = $size;
    }
    /**
    * Get downloaded.
    *
    * @return int
    */
    public function getDownloaded()
    {
        return $this->downloaded;
    }
    /**
    * Set downloaded.
    *
    * @param int $downloaded
    *
    * @return void
    */
    public function setDownloaded($downloaded)
    {
        $this->downloaded = $downloaded;
    }
    /**
    * Get time stamp.
    *
    * @return int
    */
    public function getTimeStamp()
    {
        return $this->time_stamp;
    }
    /**
    * Set time stamp.
    *
    * @param datetime $time_stamp
    *
    * @return void
    */
    public function setTimeStamp($time_stamp)
    {
        $this->time_stamp = $time_stamp;
    }
    /**
    * Get remote address.
    *
    * @return string
    */
    public function getRemoteAddr()
    {
        return $this->remote_addr;
    }
    /**
    * Set remote address.
    *
    * @param string $remote_addr
    *
    * @return void
    */
    public function setRemoteAddr($remote_addr)
    {
        $this->remote_addr = $remote_addr;
    }
}

