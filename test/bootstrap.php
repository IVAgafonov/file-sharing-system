<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

use Zend\Loader\StandardAutoloader;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;

class Bootstrap
{
    static public $config;
    static public $sm;
    static public $em;
    
    static public function init()
    {
        chdir(dirname(__DIR__));
        include 'init_autoloader.php';
        
        $loader = new StandardAutoloader();
        $loader->registerNamespace('PrgTest', __DIR__ . '/PrgTest');
        $loader->register();

        Zend\Mvc\Application::init(include 'config/application.config.php');
        
        self::$config = include 'config/application.config.php';
        self::$sm     = self::getServiceManager(self::$config);  
        self::$em     = self::getEntityManager(self::$sm);
    }
    
    static public function getServiceManager($config)
    {
        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();
        return $serviceManager;
    }
    
    static public function getEntityManager($serviceManager)
    {
        return $serviceManager->get('doctrine.entitymanager.orm_default');
    }
}

Bootstrap::init();