<?php

namespace App\Model;

use Symplefony\Database;
use Symplefony\Model\Entity;


class UserModel extends Entity
{
    private const TABLE_NAME = 'users';
    
    protected string $password;
    public function getPassword(): string { return $this->password; }
    public function setPassword( int $value ): self
    {
        $this->id = $value;
        return $this; // Permet de "chaîner" les appels aux setters: $toto->setId(2)->setName('toto'), etc.
    }
   
    protected string $email;
    public function getEmail(): string { return $this->email; }
    public function setEmail( int $value ): self
    {
        $this->email = $value;
        return $this;
    }

    protected string $firstname;
    public function getFirstname(): string { return $this->firstname; }
    public function setFirstname( int $value ): self
    {
        $this->firstname = $value;
        return $this;
    }

    protected string $lastname;
    public function getLastname(): string { return $this->lastname; }
    public function setLastname( int $value ): self
    {
        $this->lastname = $value;
        return $this;
    }

    protected string $phone_number;
    public function getPhoneNumber(): string { return $this->phone_number; }
    public function setPhoneNumber( int $value ): self
    {
        $this->phone_number = $value;
        return $this;
    }


    /* Crud: Create */
    public static function create( self $user ): ?self
    {
        $query = sprintf(
            'INSERT INTO `%s` 
                (`password`,`email`,`firstname`,`lastname`,`phone_number`) 
                VALUES (:password,:email,:firstname,:lastname,:phone_number)',
            self::TABLE_NAME
        );

        $sth = Database::getPDO()->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return null;
        }

        $success = $sth->execute([
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'phone_number' => $user->getPhoneNumber()
        ]);

        // Si echec de l'insertion
        if( ! $success ) {
            return null;
        }

        // Ajout de l'id de l'item créé en base de données
        $user->setId( Database::getPDO()->lastInsertId() );

        return $user;
    }

    /* cRud: Read tous les items */
    public static function getAll(): array
    {
        $query = sprintf(
            'SELECT * FROM `%s`',
            self::TABLE_NAME
        );

        $sth = Database::getPDO()->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return [];
        }

        $success = $sth->execute();

        // Si echec
        if( ! $success ) {
            return [];
        }

        // Récupération des résultats
        $users = [];

        while( $user_data = $sth->fetch() ) {
            $user = new UserModel( $user_data );
            $users[] = $user;
        }

        return $users;
    }

    /* cRud: Read un item par son id */
    public static function getById( int $id ): ?self
    {
        $query = sprintf(
            'SELECT * FROM `%s` WHERE id=:id',
            self::TABLE_NAME
        );

        $sth = Database::getPDO()->prepare( $query );

        // Si la préparation échoue
        if( ! $sth ) {
            return null;
        }

        $success = $sth->execute([ 'id' => $id ]);

        // Si echec
        if( ! $success ) {
            return null;
        }

        // Récupération du premier résultat
        $user = $sth->fetch();

        // Si aucun user ne correspond
        if( ! $user ) {
            return null;
        }

        return new self( $user );
    }
}