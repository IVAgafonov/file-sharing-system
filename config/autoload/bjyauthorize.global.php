<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

return array(
    'bjyauthorize' => array(
        'unauthorized_strategy' => 'Prg\Strategy\ZFURedirectionStrategy',
        'identity_provider' => 'BjyAuthorize\Provider\Identity\AuthenticationIdentityProvider',
        'role_providers' => array (
            'BjyAuthorize\Provider\Role\ObjectRepositoryProvider' => array(
                'object_manager'    => 'doctrine.entitymanager.orm_default',
                'role_entity_class' => 'Prg\Entity\Role',
             ),
        ),
        'guards' => array(
            \BjyAuthorize\Guard\Controller::class => array(
                array('controller' => array(
                        'Prg\Controller\Admin'
                    ),
                    'roles' => array('admin')
                ),
                array(
                    'controller' => array(
                        'Prg\Controller\Main',
                    ),
                    'roles' => array('guest', 'user', 'admin')
                ),
                array('controller' => array('zfcuser'), 
                    'action' => array('login', 'index', 'register'),
                    'roles' => array('guest', 'user')
                ),
                array('controller' => array('zfcuser'),
                    'action' => array('logout'),
                    'roles' => array('user', 'admin')
                ),
            )
        ),
    ),
    'service_manager' => array(
        'invokables' => array (
            'Prg\Strategy\ZFURedirectionStrategy' => 'Prg\Strategy\ZFURedirectionStrategy'
        ),
    ),
);