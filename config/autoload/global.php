<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'service_manager' => array(
        'factories' => array(
            'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
        ),
    ),
    'prg-config' => array(
        'prg-log-path' => __DIR__."/../../logs/",
        'prg-storage-dir' => __DIR__."/../../storage/",
        'path-content' => '0123456789',
        'path-length' => 12,
    )
);

