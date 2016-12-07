<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace PrgTest\Service;


use Prg\Service\FSService;

class FSServiceTest extends \PHPUnit_Framework_TestCase
{
    protected $FSService;
    protected $path;
    
    public function __construct()
    {
        $config = \Bootstrap::$sm->get('config');
        $this->FSService = new FSService($config['prg-config']);
        $this->path = "123456789012";
    }
    /**
     * @covers Prg\Service\FSService::getNewPath
     */
    public function testGetNewPath()
    {
        $path = $this->FSService->getNewPath();
        $this->assertEquals(12, strlen($path));
    }
    /**
     * @covers Prg\Service\FSService::createPath
     */
    public function testCreatePath()
    {
        $res = $this->FSService->createPath($this->path);
        $this->assertEquals(true, $res);
    }
    /**
     * @covers Prg\Service\FSService::deletePath
     */
    public function testDeletePath()
    {
        $res = $this->FSService->deletePath($this->path);
        $this->assertEquals(true, $res);
    }
    /**
     * @covers Prg\Service\FSService::moveToPath
     */
    public function testMoveToPath()
    {
        $this->FSService->createPath($this->path);
        $res = $this->FSService->moveToPath('/var/www/test11/prg/storage/a0123456789b/test.php', $this->path, 'test.txt');
        $this->assertEquals(true, $res);
    }
    /**
     * @covers Prg\Service\FSService::deleteFromPath
     */
    public function testDeleteFromPath()
    {
        $res = $this->FSService->deleteFromPath($this->path, 'test.txt');
        $this->assertEquals(true, $res);
    }
}