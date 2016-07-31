<?php

namespace PhpOfBy\AdminBundle\Controller;

use FOS\UserBundle\Model\UserInterface;
use FOS\UserBundle\Model\UserManagerInterface;
use JavierEguiluz\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;

class AdminController extends BaseAdminController
{
    /** @var UserManagerInterface */
    private $userManagerService;

    /**
     * @param UserManagerInterface $userManagerService
     */
    public function __construct(UserManagerInterface $userManagerService)
    {
        $this->userManagerService = $userManagerService;
    }

    /**
     * @return UserInterface
     */
    public function createNewUserEntity()
    {
        return $this->userManagerService->createUser();
    }

    /**
     * @param UserInterface $user
     */
    public function prePersistUserEntity(UserInterface $user)
    {
        $this->userManagerService->updateUser($user, false);
    }

    /**
     * @param UserInterface $user
     */
    public function preUpdateUserEntity(UserInterface $user)
    {
        $this->userManagerService->updateUser($user, false);
    }
}
