<?php

namespace App\Model\Repository;

use Symplefony\Database;
use Symplefony\Model\RepositoryManagerTrait;

class RepoManager
{
    use RepositoryManagerTrait;

    private UserRepository $user_repository;
    public function getUserRepo(): UserRepository { return $this->user_repository; }

    private function __construct()
    {
        $pdo = Database::getPDO();

        $this->user_repository = new UserRepository( $pdo );
    }
}