<?php

namespace App\Services\User;

use App\Exceptions\UserException;
use App\Repositories\User\UserRepositoryInterface;

class UserServices {
    public function __construct(private UserRepositoryInterface $userRepository){}

    public function cadastro(array $payload): void {
        $this->verificaSeEmailJaExiste($payload['email']);
        $this->userRepository->cadastro($payload);
    }

    public function login(array $payload): array {
        $this->autenticacao($payload);
        return [
            'token' => auth()->user()->createToken('create_token')->plainTextToken,
            'user' => auth()->user()->only(['id', 'name', 'email'])
        ];
    }

    private function verificaSeEmailJaExiste(string $email): void {
        if((bool)$this->userRepository->verificaSeEmailJaExiste($email)) throw UserException::EmailJaExiste();
    }

    private function autenticacao(array $credenciais): void {
        if(!auth()->attempt($credenciais)) throw UserException::EmailESenhaInvalidos();
    }
}
