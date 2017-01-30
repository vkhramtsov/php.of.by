<?php

namespace PhpOfBy\SecurityBundle\Service;

use Doctrine\Common\Persistence\ObjectManager;
use FOS\UserBundle\Doctrine\UserManager;
use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Util\CanonicalFieldsUpdater;
use FOS\UserBundle\Util\PasswordUpdaterInterface;

class UserManagerServiceDoctrineOrm extends UserManager implements UserManagerServiceInterface
{
    /**
     * Constructor.
     *
     * @param PasswordUpdaterInterface $passwordUpdater
     * @param CanonicalFieldsUpdater   $canonicalFieldsUpdater
     * @param ObjectManager            $om
     * @param string                   $class
     * @SuppressWarnings(PHPMD.LongVariable)
     * @SuppressWarnings(PHPMD.ShortVariable)
     */
    public function __construct(
        PasswordUpdaterInterface $passwordUpdater,
        CanonicalFieldsUpdater $canonicalFieldsUpdater,
        ObjectManager $om,
        $class
    ) {
        parent::__construct($passwordUpdater, $canonicalFieldsUpdater, $om, $class);
    }

    /**
     * @param array $criteria
     *
     * @return UserInterface
     */
    public function findUserBy(array $criteria)
    {
        if (array_key_exists('id', $criteria)) {
            $criteria['userId'] = $criteria['id'];
            unset($criteria['id']);
        }

        return parent::findUserBy($criteria);
    }
}
