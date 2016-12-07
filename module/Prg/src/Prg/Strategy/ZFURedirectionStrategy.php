<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Strategy;


use BjyAuthorize\View\RedirectionStrategy;
use Zend\EventManager\EventManagerInterface;

class ZFURedirectionStrategy extends RedirectionStrategy
{
    public function __construct()
    {
        $this->setRedirectRoute('zfcuser');
    }
}

