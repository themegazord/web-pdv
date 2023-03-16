<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Http\Requests\UserCadastroRequest;
use App\Http\Requests\UserLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Services\User\UserServices;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(private UserServices $userServices) {}

    public function cadastro(UserCadastroRequest $request): JsonResponse {
        try {
            $credenciais = $request->only('name', 'email', 'password');
            $credenciais['password'] = Hash::make($credenciais['password']);
            $this->userServices->cadastro($credenciais);
            return response()->json(['msg' => 'Usuário cadastrado com sucesso'], Response::HTTP_CREATED);
        } catch (UserException $ex) {
            return response()->json(['erro' => $ex->getMessage()], $ex->getCode());
        }
    }

    public function login(UserLoginRequest $request): JsonResponse {
        try {
            $credenciais = $request->only('email', 'password');
            return response()->json($this->userServices->login($credenciais));
        } catch (UserException $ex) {
            return response()->json(['erro' => $ex->getMessage()], $ex->getCode());
        }
    }
}
