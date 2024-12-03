<?php

namespace App\Model\Repository;

use App\Model\Entity\Category;
use Symplefony\Model\Repository;

class CategoryRepository extends Repository
{
    protected function getTableName(): string { return 'categories'; }

    /* Crud: create */
    public function create( Category $category ): ?Category
    {
        $query = sprintf(
            'INSERT INTO `%s` 
                (`label`) 
                VALUES (:label)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return null;
        }

        $success = $sth->execute([
            'label' => $category->getLabel()
        ]);

        // Si echec de l'insertion
        if( ! $success ) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $category->setId( $this->pdo->lastInsertId() );

        return $category;
    }
    
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

    /* crUd: Update */
    public function update( Category $category ): ?Category
    {
        $query = sprintf(
            'UPDATE `%s` 
                SET `label`=:label
                WHERE id=:id',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return null;
        }

        $success = $sth->execute([
            'label' => $category->getLabel(),
            'id' => $category->getId()
        ]);

        // Si echec de la mise à jour
        if( ! $success ) {
            return null;
        }

        return $category;
    }
}