<?php

/* 
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Factory\Mapper;


interface MapperFactoryInterface
{
    /**
    * Create Courier mapper.
    *
    * @return Prg\Entity\CourierInterface
    */
    public function createStorageMapper();
}