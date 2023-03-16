<?php

namespace App\Repositories\User;

use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface {
    public function cadastro(array $payload): void;
    public function verificaSeEmailJaExiste(string $email): Model|null;
}
