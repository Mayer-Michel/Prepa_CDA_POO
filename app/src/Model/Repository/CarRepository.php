<?php

namespace App\Model\Repository;

use App\Model\Entity\Car;
use Symplefony\Model\Repository;

class CarRepository extends Repository
{
    protected function getTableName(): string { return 'cars'; }

    /* Crud: create */
    public function create( Car $car ): ?Car
    {
        $query = sprintf(
            'INSERT INTO `%s` 
                (`label`, `seats`, `energy`, `plate_number`, `price_day`, `price_distance`, `image`) 
                VALUES (:label, :seats, :energy, :plate_number, :price_day, :price_distance, :image)',
            $this->getTableName()
        );

        $sth = $this->pdo->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return null;
        }

        $success = $sth->execute([
            'label' => $car->getLabel(),
            'seats' => $car->getSeats(),
            'energy' => $car->getEnergy(),
            'plate_number' => $car->getPlate_number(),
            'price_day' => $car->getPrice_day(),
            'price_distance' => $car->getPrice_distance(),
            'image' => $car->getImage()
        ]);

        // Si echec de l'insertion
        if( ! $success ) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $car->setId( $this->pdo->lastInsertId() );

        return $car;
    }

    /* cRud: Read tous les items */
    public function getAll(): array
    {
        return $this->readAll( Car::class );
    }

    /* cRud: Read un item par son id */
    public function getById( int $id ): ?Car
    {
        return $this->readById( Car::class, $id );
    }
}