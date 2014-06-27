<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Security\Authentication\Authenticator;

use Aegis\Authentication\Authenticator\AuthenticatorInterface;
use Aegis\Authentication\Token\AuthenticationTokenInterface;
use Aegis\Exception\AuthenticationException;
use Doctrine\ORM\EntityManager;
use SeerUK\Module\TestModule\Data\Entity\User;
use SeerUK\Module\TestModule\Data\Repository\UserRepository;
use SeerUK\Module\TestModule\Security\Authentication\Token\TestUserToken;
use Symfony\Component\HttpFoundation\Request;

/**
 * Test User Authenticator.
 *
 * For debugging purposes only.
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class TestUserAuthenticator implements AuthenticatorInterface
{
    private $repository;

    /**
     * Constructor.
     *
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->repository = $em->getRepository(User::class);
    }

    /**
     * {@inheritDoc}
     */
    public function authenticate(AuthenticationTokenInterface $token)
    {
        if ( ! isset($this->repository)) {
            throw new \RuntimeException('No repository found to fetch user from.');
        }

        if ( ! $this->repository instanceof UserRepository) {
            throw new \RuntimeException(sprintf(
                'Cannot fetch user from an unsupported repository: "%s"',
                get_class($this->repository)
            ));
        }

        $credentials = $token->getCredentials();

        $user = $this->repository->findOneByUsername($credentials['username']);

        // Validate the user is the same user:
        if ($credentials['password'] !== $user->getPassword()) {
            throw new AuthenticationException($token, 'Bad credentials');
        }

        // This would be where you'd grab the real user object.
        $token->setUser($user);

        // Do something to validate user credentials from token
        $token->setAuthenticated(count($token->getUser()->getRoles()) > 0);

        return $token;
    }

    /**
     * {@inheritDoc}
     */
    public function supports()
    {
        return TestUserToken::class;
    }
}
