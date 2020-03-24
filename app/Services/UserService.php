<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getUser(string $email, string $password) 
    {
        return $this->repository->getUser($email, $password);
    }
}
