<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Factory\Service;


interface ServiceFactoryInterface
{
    /**
     * Create logger service.
     *
     * @return Bcrypt
     */
    public function createLoggerService();
    /**
     * Create file system service.
     *
     * @return Bcrypt
     */
    public function createFSService();
    /**
     * Create Bcrypt.
     *
     * @return Bcrypt
     */
    public function createBcrypt();
}

