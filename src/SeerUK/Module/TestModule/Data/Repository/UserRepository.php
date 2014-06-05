<?php

/*
 * This file is part of Trident.
 *
 * (c) Elliot Wright <elliot@elliotwright.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SeerUK\Module\TestModule\Data\Repository;

use Doctrine\ORM\EntityRepository;
use Trident\Component\Caching\CachingProxy;

/**
 * User Repository
 *
 * @author Elliot Wright <elliot@elliotwright.co>
 */
class UserRepository extends EntityRepository
{
    protected $cachingProxy;

    public function findAll()
    {
        return $this->cachingProxy->proxy('users', function() {
            $builder = $this->getEntityManager()->createQueryBuilder();

            $query = $builder
                ->select('u')
                ->from('SeerUK\Module\TestModule\Data\Entity\User', 'u')
                ->getQuery();

            return $query->getResult();
        }, 300);
    }

    /**
     * Set caching proxy.
     *
     * @param CachingProxy $cachingProxy
     *
     * @return UserRepository
     */
    public function setCachingProxy(CachingProxy $cachingProxy)
    {
        $this->cachingProxy = $cachingProxy;

        return $this;
    }

    /**
     * Get caching proxy.
     *
     * @return CachingProxy
     */
    public function getCachingProxy()
    {
        return $this->cachingProxy;
    }
}
