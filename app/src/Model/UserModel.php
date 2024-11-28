<?php
namespace App\Model;

use Symplefony\Database;
use Symplefony\Model\Model;
class UserModel extends Model
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

    /* CRUD: Create */
    public static function create( self $user ): ?self
    {
        $query = sprintf('INSERT INTO `%s` (`password`, `email`, `firstname`, `lastname`, `phone_number`) VAlUES (:password, :email, :firstname, :lastname, :phone_number)', self::TABLE_NAME);

        $sth = Database::getPDO()->prepare( $query );
        
        // Si la prepartion échoue
        if( ! $sth ){
            return null;
        }

        $success = $sth->execute([
            'password' => $user->getPassword(),
            'email' => $user->getEmail(),
            'firstname' => $user->getFirstname(),
            'lastname' => $user->getLastname(),
            'phone_number' => $user->getPhoneNumber()
        ]);

        if( ! $success ){
            return null;
        }

        // Ajout de l'id de l'item crée en base de données
        $user->setId( Database::getPDO()->lastInsertId() );

        return $user;
    }


    public static function find_id(int $id): ?self
    {
        $query = sprintf('SELECT * FROM `%s` WHERE `id` = :id', self::TABLE_NAME);
        $sth = Database::getPDO()->prepare($query);

        if(!$sth){
            return null;
        }

        $sth->execute(['id' => $id]);
        $data = $sth->fetch();

        if(!$data){
            return null;
        }

        return new self($data);
    }

}