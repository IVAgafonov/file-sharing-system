<?php

/*
 * @Copyright (C) 2016 Igor Agafonov
 * @licenseGPL
 */

namespace Prg\Entity;


interface UserInterface
{
    /**
     * Get id.
     *
     * @return int
     */
    public function getId();
    /**
     * Set user_id.
     *
     * @param int $user_id
     *
     * @return void
     */
    public function setId($user_id);
    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername();
    /**
     * Set username.
     *
     * @param string $username
     *
     * @return void
     */
    public function setUsername($username);
    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail();
    /**
     * Set email.
     *
     * @param string $email
     *
     * @return void
     */
    public function setEmail($email);
    /**
     * Get displayName.
     *
     * @return string
     */
    public function getDisplayName();
    /**
     * Set display_name.
     *
     * @param string $display_name
     *
     * @return void
     */
    public function setDisplayName($display_name);
    /**
     * Get password.
     *
     * @return string
     */
    public function getPassword();
    /**
     * Set password.
     *
     * @param string $password
     *
     * @return void
     */
    public function setPassword($password);
    /**
     * Get state.
     *
     * @return int
     */
    public function getState();
    /**
     * Set state.
     *
     * @param int $state
     *
     * @return void
     */
    public function setState($state);
    /**
     * Get role.
     *
     * @return array
     */
    public function getRoles();
    /**
     * Add a role to the user.
     *
     * @param Role $role
     *
     * @return void
     */
    public function addRole($role);
}

