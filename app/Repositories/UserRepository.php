<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository
{
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function getUser(string $email, string $password)
    {
        return $this->model
                    ->where('email', $email)
                    ->where('password', $password)->first();
    }
}
