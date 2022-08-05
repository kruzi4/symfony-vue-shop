<?php

namespace App\Utils\Manager;

use App\Entity\User;
use Doctrine\Persistence\ObjectRepository;

class UserManager extends AbstractBaseManager
{

    public function getRepository(): ObjectRepository
    {
        return $this->entityManager->getRepository(User::class);
    }

    /**
     * @param object|User $user
     * @return void
     */
    public function remove(object $user): void
    {
        $user->setIsDeleted(true);
        $this->save($user);
    }
}