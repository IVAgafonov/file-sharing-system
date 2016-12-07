<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */


namespace PrgTest\Entity;


use Prg\Entity\Storage;
use Prg\Mapper\StorageMapper;
use Prg\Exception\PrgException;

class StorageMapperTest extends \PHPUnit_Framework_TestCase
{
    protected $storage;
    protected $storageMapper;

    public function setUp()
    {
        $em = \Bootstrap::$em;
        $storage = new Storage();
        $storageMapper = new StorageMapper($em ,$storage);
        $this->storage = $storage;
        $this->storageMapper = $storageMapper;
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
     * @covers Prg\Mapper\StorageMapper::toArray
     * @covers Prg\Mapper\StorageMapper::toEntity
     */
    public function testToArrayToEntity()
    {
        $storageEntity = $this->storageMapper->toEntity(
            array(
                'id' => 1,
                'name' => '1.txt',
                'path' => '0123456789012',
                'credential' => 'fv72j4fcs972342ef8v3v3cv',
                'size' => 1000,
                'time_stamp' => '2016-12-06 14:15:16',
                'downloaded' => 300,
                'remote_addr' => '127.0.0.1'
            )
        );
        $this->assertInstanceOf('Prg\Entity\Storage', $storageEntity);
        $storageArray  = $this->storageMapper->toArray($storageEntity);
        $this->assertEquals(1, $storageArray['id']);
        $this->assertEquals('1.txt', $storageArray['name']);
        $this->assertEquals('0123456789012', $storageArray['path']);
        $this->assertEquals('fv72j4fcs972342ef8v3v3cv', $storageArray['credential']);
        $this->assertEquals(1000, $storageArray['size']);
        $this->assertEquals(new \DateTime('2016-12-06 14:15:16'), $storageArray['time_stamp']);
        $this->assertEquals(300, $storageArray['downloaded']);
        $this->assertEquals('127.0.0.1', $storageArray['remote_addr']);
    }
    /**
     * @covers Prg\Mapper\StorageMapper::add
     */
    public function testToAdd()
    {
        $storageEntity = $this->storageMapper->toEntity(
            array(
                'id' => 1,
                'name' => '1.txt',
                'path' => '0123456789012',
                'credential' => 'fv72j4fcs972342ef8v3v3cv',
                'size' => 1000,
                'time_stamp' => new \DateTime('2016-12-06 14:15:16'),
                'downloaded' => 300,
                'remote_addr' => '127.0.0.1'
            )
        );
        $storageId = $this->storageMapper->add($storageEntity);
        $this->assertEquals(1, $storageId);
    }
    /**
     * @covers Prg\Mapper\StorageMapper::edit
     * @covers Prg\Mapper\StorageMapper::getById
     */
    public function testToGetByIdAndEdit()
    {
        $oldStorage = $this->storageMapper->getById(1);
        $this->assertInstanceOf('Prg\Entity\StorageInterface', $oldStorage);

        $oldName = $oldStorage->getName();
        $this->assertEquals('1.txt', $oldName);
        $oldStorage->setName('2.txt');

        $oldPath = $oldStorage->getPath();
        $this->assertEquals('0123456789012', $oldPath);
        $oldStorage->setPath('999999999999');

        $oldCredential = $oldStorage->getCredential();
        $this->assertEquals('fv72j4fcs972342ef8v3v3cv', $oldCredential);
        $oldStorage->setCredential('2342ef8v3v3cvfv72j4fcs97');

        $oldSize = $oldStorage->getSize();
        $this->assertEquals(1000, $oldSize);
        $oldStorage->setSize(2000);

        $oldTimeStamp = $oldStorage->getTimeStamp();
        $this->assertEquals(new \DateTime('2016-12-06 14:15:16'), $oldTimeStamp);
        $oldStorage->setTimeStamp(new \DateTime('2016-12-06 14:15:26'));

        $oldDownloaded = $oldStorage->getDownloaded();
        $this->assertEquals(300, $oldDownloaded);
        $oldStorage->setDownloaded(500);
        
        $oldRemoteAddr = $oldStorage->getRemoteAddr();
        $this->assertEquals('127.0.0.1', $oldRemoteAddr);
        $oldStorage->setRemoteAddr('127.0.0.2');
        
        $storageId = $this->storageMapper->edit($oldStorage);
        $this->assertEquals(1, $storageId);
        
        $editedStorage = $this->storageMapper->getById(1);
        $this->assertEquals('2.txt', $editedStorage->getName());
        $this->assertEquals('999999999999', $editedStorage->getPath());
        $this->assertEquals('2342ef8v3v3cvfv72j4fcs97', $editedStorage->getCredential());
        $this->assertEquals(2000, $editedStorage->getSize());
        $this->assertEquals(new \DateTime('2016-12-06 14:15:26'), $editedStorage->getTimeStamp());
        $this->assertEquals(500, $editedStorage->getDownloaded());
        $this->assertEquals('127.0.0.2', $editedStorage->getRemoteAddr());
    }
    /**
     * @covers Prg\Mapper\StorageMapper::getById
     */
    public function testToFailGetById()
    {
        try {
            $res = $this->storageMapper->getById(999999);
            $this->assertNull($res);
        } catch (PrgException $ex) {
            $this->assertEquals($ex->getMessage(), 'File not found');
            return;
        }
        $this->fail("Expected Exception has not been thrown.");
    }
    /**
     * @covers Prg\Mapper\StorageMapper::getStorageList
     */
    public function testToFailGetStorageList()
    {
        //$storageList = $this->storageMapper->getStorageList();
        //$this->assertEquals(0, $storageList);
    }
    /**
     * @covers Prg\Mapper\StorageMapper::getStorageList
     */
    public function testToGetStorageList()
    {
        #$storageList = $this->storageMapper->getStorageList("Pet");
        #$this->assertInstanceOf('Prg\Entity\StorageInterface', $storageList[0]);
    }
    /**
     * @covers Prg\Mapper\StorageMapper::delete
     */
    public function testToDelete()
    {
        $res = $this->storageMapper->delete(1);
        $this->assertEquals(0, $res);
    }
}

