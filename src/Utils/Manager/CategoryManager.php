<?php

namespace App\Utils\Manager;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Persistence\ObjectRepository;

class CategoryManager extends AbstractBaseManager
{

    public function getRepository(): ObjectRepository
    {
        return $this->entityManager->getRepository(Category::class);
    }

    /**
     * @param Category $category
     * @return void
     */
    public function remove(object $category): void
    {
        $category->setIsDeleted(true);

        /**
         * @var Product
         */
        foreach ($category->getProducts()->getValues() as $product) {
            $product->setIsDeleted(true);
        }

        $this->save($category);
    }
}