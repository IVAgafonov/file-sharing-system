<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */


namespace PrgTest\Entity;


use Prg\Entity\User;

class UserTest extends \PHPUnit_Framework_TestCase
{
    public function testInitial()
    {
        $user = new User();
        $this->assertNull($user->getId());
        $this->assertNull($user->getUsername());
        $this->assertNull($user->getEmail());
        $this->assertNull($user->getDisplayName());
        $this->assertNull($user->getPassword());
        $this->assertNull($user->getState());              
        $this->assertEmpty($user->getRoles()); 
    }
}

