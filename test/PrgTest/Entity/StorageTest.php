<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */


namespace PrgTest\Entity;


use Prg\Entity\Storage;

class StorageTest extends \PHPUnit_Framework_TestCase
{
    protected $storage;

    public function setUp()
    {
        $storage = new Storage();
        $this->storage = $storage;
    }
    public function testInitial()
    {
        $this->assertNull($this->storage->getId());
        $this->assertNull($this->storage->getName());
        $this->assertNull($this->storage->getPath());
        $this->assertNull($this->storage->getCredential());
        $this->assertNull($this->storage->getSize());
        $this->assertNull($this->storage->getDownloaded());
        $this->assertNull($this->storage->getTimeStamp());
        $this->assertNull($this->storage->getRemoteAddr());
    }
    /**
     * @covers Prg\Entity\Storage::setId
     * @covers Prg\Entity\Storage::getId
     */
    public function testSetGetId()
    {
        $this->storage->setId(1);
        $this->assertEquals(1, $this->storage->getId());
    }
    /**
     * @covers Prg\Entity\Storage::setName
     * @covers Prg\Entity\Storage::getName
     */
    public function testSetGetName()
    {
        $this->storage->setName("1.txt");
        $this->assertEquals("1.txt", $this->storage->getName());
    }
    /**
     * @covers Prg\Entity\Storage::setPath
     * @covers Prg\Entity\Storage::getPath
     */
    public function testSetGetPath()
    {
        $this->storage->setPath("0123456789");
        $this->assertEquals("0123456789", $this->storage->getPath());
    }
    /**
     * @covers Prg\Entity\Storage::setCredential
     * @covers Prg\Entity\Storage::getCredential
     */
    public function testSetGetCredential()
    {
        $this->storage->setCredential(md5('password'));
        $this->assertEquals(md5('password'), $this->storage->getCredential());
    }
    /**
     * @covers Prg\Entity\Storage::setSize
     * @covers Prg\Entity\Storage::getSize
     */
    public function testSetGetSize()
    {
        $this->storage->setSize(1000000);
        $this->assertEquals(1000000, $this->storage->getSize());
    }
    /**
     * @covers Prg\Entity\Storage::setDownloaded
     * @covers Prg\Entity\Storage::getDownloaded
     */
    public function testSetGetDownloaded()
    {
        $this->storage->setDownloaded(10);
        $this->assertEquals(10, $this->storage->getDownloaded());
    }
    /**
     * @covers Prg\Entity\Storage::setTimeStamp
     * @covers Prg\Entity\Storage::getTimeStamp
     */
    public function testSetGetTimeStamp()
    {
        $this->storage->setTimeStamp(new \DateTime("2016-12-06 10:10:10"));
        $this->assertEquals(new \DateTime("2016-12-06 10:10:10"), $this->storage->getTimeStamp());
    }
    /**
     * @covers Prg\Entity\Storage::setRemoteAddr
     * @covers Prg\Entity\Storage::getRemoteAddr
     */
    public function testSetGetRemoteAddr()
    {
        $this->storage->setRemoteAddr("127.0.0.1");
        $this->assertEquals("127.0.0.1", $this->storage->getRemoteAddr());
    }
}
