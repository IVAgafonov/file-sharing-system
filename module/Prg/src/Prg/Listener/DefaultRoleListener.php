<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Listener;


use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\Event;

class DefaultRoleListener extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events)
    {
        $sharedManager = $events->getSharedManager();
        $this->listeners[] = $sharedManager->attach(
            'ZfcUser\Service\User',
            'register',
            array($this, 'onRegister')
        );
    }

    public function onRegister(Event $e)
    {
        $sm = $e->getTarget()->getServiceManager();
        $em = $sm->get('doctrine.entitymanager.orm_default');
        $user = $e->getParam('user');
        $config = $sm->get('config');
        $criteria = array('role_id' => $config['zfcuser']['new_user_default_role']);
        $defaultUserRole = $em->getRepository('Prg\Entity\Role')->findOneBy($criteria);

        if ($defaultUserRole !== null) {
            $user->addRole($defaultUserRole);
        }
    }
}

