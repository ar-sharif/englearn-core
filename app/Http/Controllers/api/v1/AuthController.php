<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Requests\AuthRequests\LoginRequest;
use App\Http\Requests\AuthRequests\RegisterRequest;
use App\Http\Resources\Auth\LoginResource;
use App\Http\Resources\Auth\RegisterResource;
use App\Http\Resources\User\UserResource;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;

class AuthController extends BaseController
{
    public function __construct(
        private readonly AuthService $authService
    )
    {

    }

    public function login(LoginRequest $request): JsonResponse
    {
        $data = $this->authService->login($request->validated());
        return Response::data(LoginResource::make($data), __('auth.login'));
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $data = $this->authService->register($request->validated());
        return Response::data(RegisterResource::make($data), __('auth.register'));
    }

    public function logout()
    {
        $data = $this->authService->logout();
        return Response::data($data, __('auth.logout'));
    }

    public function me()
    {
        $data = $this->authService->me();
        return Response::data(UserResource::make($data));
    }
}
