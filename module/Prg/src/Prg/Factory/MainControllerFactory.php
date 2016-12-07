<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Factory;


use Prg\Facade\ExchangeFacade;
use Prg\Factory\Mapper\MapperFactory;
use Prg\Factory\Service\ServiceFactory;
use Prg\Controller\MainController;
use Prg\Strategy\PHPDownloadStrategy;
use Prg\Strategy\XSFDownloadStrategy;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class MainControllerFactory implements FactoryInterface
{
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->getServiceLocator()->get('config');
        
        $em = $serviceLocator->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        
        $mapperFactory = new MapperFactory($em);
        $serviceFactory = new ServiceFactory($config['prg-config']);
        //$downloadStrategy = new PHPDownloadStrategy();
        $downloadStrategy = new XSFDownloadStrategy();
        $exchangeFacade = new ExchangeFacade($mapperFactory, $serviceFactory, $downloadStrategy);
        
        $mainController = new MainController($exchangeFacade);
        return $mainController;
    }
}

