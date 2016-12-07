<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

return array('doctrine' => array(
        'driver' => array(
            'zfcuser_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__.'/../../module/Prg/src/Prg/Entity/'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Prg' => 'zfcuser_entity',
                ),
            ),
            'orm_host0' => array(
                'drivers' => array(
                    'Prg' => 'zfcuser_entity',
                ),
            ),
        ),
        'connection' => array(
            // default connection
            'orm_default' => array(
                'driverClass' => 'Doctrine\DBAL\Driver\PDOMySql\Driver',
                'params' => array(
                    'host'     => 'host',
                    'port'     => '3306',
                    'user'     => 'user',
                    'password' => 'password',
                    'dbname'   => 'dbname',
                    'charset'  => 'utf8',
                    'driverOptions' => array(
                        1002 => 'SET NAMES utf8'
                    ) 
                )
            )    
        )
    )
);

