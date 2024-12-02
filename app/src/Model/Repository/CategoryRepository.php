<?php

namespace App\Model\Repository;

use App\Model\Entity\Category;
use Symplefony\Model\Repository;

class CategoryRepository extends Repository
{
    protected function getTableName(): string { return 'categories'; }

    /* Creud: create */
    

    /* cRud: Read tous les items */
    public function getAll(): array
    {
        return $this->readAll( Category::class );
    }

    /* cRud: Read un item par son id */
    public function getById( int $id ): ?Category
    {
        return $this->readById( Category::class, $id );
    }
}