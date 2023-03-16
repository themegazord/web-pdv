<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserEloquentRepository implements UserRepositoryInterface {
    public function cadastro(array $payload): void
    {
        User::query()
            ->create($payload);
    }

    public function verificaSeEmailJaExiste(string $email): Model|null
    {
        return User::query()
            ->where('email', $email)
            ->first();
    }
}
