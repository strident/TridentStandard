<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Security\Authorization\Voter;

use Aegis\Authorization\Voter\VoterInterface;
use Aegis\Token\TokenInterface;

/**
 * User Repo Voter
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserRepoVoter implements VoterInterface
{
    /**
     * {@inheritDoc}
     */
    public function vote(TokenInterface $token, array $attributes, $object = null)
    {
        if (null === $object || ! $this->supportsClass($object)) {
            return VoterInterface::ACCESS_ABSTAIN;
        }

        // Imagine that the roles here are coming from the database, and not
        // in-memory, and that they're OO, not just arrays
        $permissions = [
            'ROLE_USER' => [
                'READ'
            ],
            'ROLE_ADMIN' => [
                'READ',
                'WRITE'
            ],
            'ROLE_SUPER_ADMIN' => [
                'READ',
                'WRITE'
            ]
        ];

        $userRoles = $token->getRoles();
        $granted   = 0;

        foreach ($attributes as $attribute) {
            // Loop over each role and check if any of them have permissions on
            // the object.
            foreach ($userRoles as $userRole) {
                // If the role doesn't exist in the permissions just ignore it.
                if ( ! array_key_exists($userRole, $permissions)) {
                    continue;
                }

                // If the permission is available for the current user role then
                // increase granted and stop looking for other roles that have
                // permission.
                if (in_array($attribute, $permissions[$userRole])) {
                    $granted++;
                    break;
                }
            }
        }

        return ($granted === count($attributes))
            ? VoterInterface::ACCESS_GRANTED
            : VoterInterface::ACCESS_DENIED;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsAttribute($attribute)
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function supportsClass($object)
    {
        if ( ! is_object($object)) {
            return false;
        }

        return ('SeerUK\Module\TestModule\Data\Repository\UserRepository' === get_class($object));
    }
}
