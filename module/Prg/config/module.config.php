<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

return array(
    'router' => array(
        'routes' => array(
            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route' => '/',
                    'defaults' => array(
                        'controller' => 'Prg\Controller\Main',
                        'action' => 'index',
                    )
                )
            ),
            'download' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/dn[/:path]',
                    'constraints' => array(
                        'path' => '[a-zA-Z0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Prg\Controller\Main',
                        'action' => 'download',
                    )
                )
            ),
            'upload' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/upload[/:path]',
                    'constraints' => array(
                        'path' => '[a-zA-Z0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Prg\Controller\Main',
                        'action' => 'upload',
                    )
                )
            ),
            'admin' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/admin[/:page][/:filter]',
                    'constraints' => array(
                        'page' => '[0-9]*',
                        'filter' => '[a-zA-Z0-9]*',
                    ),
                    'defaults' => array(
                        'controller' => 'Prg\Controller\Admin',
                        'action' => 'index',
                    )
                )
            ),
        )    
    ),     
    'controllers' => array(
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Prg\Controller\Main' => 'Prg\Factory\MainControllerFactory',
            'Prg\Controller\Admin' => 'Prg\Factory\AdminControllerFactory',
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'         => __DIR__ .'/../view/prg/layout/default.phtml',
            'prg/layout/admin'      => __DIR__ .'/../view/prg/layout/admin.phtml',
            'prg/layout/main'       => __DIR__ .'/../view/prg/layout/main.phtml',
            'error/404'             => __DIR__ .'/../view/error/404.phtml',
            'error/index'           => __DIR__ .'/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__.'/../view'
        ),
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'view_helpers' => array(
        'invokables'=> array(
            'PaginationStorageFilteredHelper' => 'Prg\Helper\PaginationStorageFilteredHelper',
            'BytesFormatHelper' => 'Prg\Helper\BytesFormatHelper',
        )
    ),
    'navigation' => array(
        'default' => array(
            array(
                'label' => _(''),
                'route' => 'home',
            ),
            array(
                'label' => _(''),
                'route' => 'download',
            ),
        )
    ),
    'translator' => array(
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),
    'prg-config' => array (
        'languages' => array(
            array('ru_RU',_('Russian'),'Ru'),
            array('en_US',_('English'),'En'),
        )
    )
);

