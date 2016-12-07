<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg;


use Zend\EventManager\EventInterface;
use Prg\Listener\DefaultRoleListener;
use Prg\Listener\UserLoginListener;
use Prg\Listener\LanguageListener;
use Prg\Factory\Service\ServiceFactory;

class Module
{
    private $sm;
    
    public function onBootstrap(EventInterface $e)
    {
        $em = $e->getApplication()->getEventManager();
        $em->attach(new DefaultRoleListener());
        $userLogginListener = new UserLoginListener();
        $this->sm = $e->getApplication()->getServiceManager();
        $config = $this->sm->get('Config');
        $userLogginListener->setServiceFactory(new ServiceFactory($config['prg-config']));
        $em->attach($userLogginListener);
        $em->attach(new LanguageListener());
    }

    public function init(\Zend\ModuleManager\ModuleManager $mm)
    {
        $sharedEvents = $mm->getEventManager()->getSharedManager();
        $sharedEvents->attach(
            'Prg\Controller\AdminController',
            'dispatch',
            function ($e) {
                $controller = $e->getTarget();
                $controller->layout('prg/layout/admin');
                $user = $this->sm->get('zfcuser_auth_service')->getIdentity();
                $controller->layout()->user = $user;
            },
            100
        );
        $sharedEvents->attach(
            array(
                'Prg\Controller\MainController'
            ),
            'dispatch',
            function ($e) {
                $controller = $e->getTarget();
                $controller->layout('prg/layout/main');
            },
            100
        );
    }

    public function getConfig()
    {
        return include __DIR__.'/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__.'/src/'.__NAMESPACE__,
                )
            )
        );
    }
}

