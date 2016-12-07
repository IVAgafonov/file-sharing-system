<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Factory\Mapper;


use Prg\Entity\Storage;
use Prg\Mapper\StorageMapper;

class MapperFactory implements MapperFactoryInterface
{
    protected $em;
    /**
    * Constructor.
    *
    * @param EntityManager $em
    *
    * @return void
    */
    public function __construct($em)
    {
        $this->em = $em;
    }
    /**
    * Create storage mapper.
    *
    * @return Prg\Entity\StorageInterface
    */
    public function createStorageMapper()
    {
        return new StorageMapper($this->em, new Storage());
    }
}

