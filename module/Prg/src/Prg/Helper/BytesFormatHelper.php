<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Helper;

use Zend\View\Helper\AbstractHelper;

class BytesFormatHelper extends AbstractHelper
{

    public function __invoke($bytes, $dec = 2)
    {
        $base = log($bytes, 1024);
        $suffixes = array('', 'K', 'M', 'G', 'T');   

        return round(pow(1024, $base - floor($base)), $dec) .' '. $suffixes[floor($base)];
    }
}

