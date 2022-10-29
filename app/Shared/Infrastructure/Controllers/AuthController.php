<?php

namespace App\Shared\Infrastructure\Controllers;

use App\Shared\Application\Command\CommandBusInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\Security\UserFetcher;
use App\Users\Application\Command\Create\CreateUserCommand;
use App\Users\Application\Query\GetByEmail\GetUserByEmailQuery;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

final class AuthController extends Controller
{
    public function __construct(
        private readonly CommandBusInterface $commandBus,
        private readonly QueryBusInterface $queryBus,
        private readonly UserFetcher $userFetcher,
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function login(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = $this->userFetcher->getAuthUser()->toArray();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'login' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $this->commandBus->dispatch(
            new CreateUserCommand(
                $request->get('login'),
                $request->get('email'),
                $request->get('password'),
            )
        );

        $user = $this->queryBus->ask(
            new GetUserByEmailQuery($request->get('email'))
        );

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    public function refresh(): JsonResponse
    {
        $user = $this->userFetcher->getAuthUser()->toArray();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => Auth::refresh(),
                'type' => 'bearer',
            ],
        ]);
    }
}
