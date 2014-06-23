<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Security\Authentication\Token;

use Aegis\Authentication\Token\AuthenticationTokenInterface;
use Aegis\User\UserInterface;
use SeerUK\Module\TestModule\Data\Entity\User;

/**
 * Test User Token
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class TestUserToken implements AuthenticationTokenInterface
{
    private $authenticated = false;
    private $credentials;
    private $user;

    public function __construct($credentials)
    {
        $this->credentials = $credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function getRoles()
    {
        return $this->getUser()->getRoles();
    }

    /**
     * {@inheritDoc}
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * {@inheritDoc}
     */
    public function setUser(UserInterface $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCredentials()
    {
        return $this->credentials;
    }

    /**
     * {@inheritDoc}
     */
    public function flushCredentials()
    {
        unset($this->credentials);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function isAuthenticated()
    {
        return $this->authenticated;
    }

    /**
     * {@inheritDoc}
     */
    public function setAuthenticated($authenticated)
    {
        $this->authenticated = (bool) $authenticated;

        return $this;
    }
}
