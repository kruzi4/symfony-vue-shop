<?php

namespace App\Utils\Manager;

use App\Entity\Category;
use Doctrine\Persistence\ObjectRepository;

class CategoryManager extends AbstractBaseManager
{

    public function getRepository(): ObjectRepository
    {
        return $this->entityManager->getRepository(Category::class);
    }
}