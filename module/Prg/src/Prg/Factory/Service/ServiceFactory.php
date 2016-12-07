<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Factory\Service;

use Zend\Crypt\Password\Bcrypt;
use Prg\Service\System\LoggerService;
use Prg\Service\FSService;

class ServiceFactory implements ServiceFactoryInterface
{
    private $config;

    public function __construct($config)
    {
        $this->config = $config;
    }
    /**
     * Create logger service.
     *
     * @return Bcrypt
     */
    public function createLoggerService()
    {
        return new LoggerService($this->config);
    }
    /**
     * Create file system service.
     *
     * @return Bcrypt
     */
    public function createFSService()
    {
        return new FSService($this->config);
    }
    /**
     * Create Bcrypt.
     *
     * @return Bcrypt
     */
    public function createBcrypt()
    {
        $bcrypt = new Bcrypt();
        $bcrypt->setCost(14);
        return $bcrypt;
    }
}

