<?php

namespace Apps\LaravelApp\Http\Controllers;

use App\Users\Infrastructure\Adapter\UserAdapter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Routing\Annotation\Route;

final class AuthController extends Controller
{
    public function __construct(
        private readonly UserAdapter $userAdapter
    ) {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    #[Route('/api/login', name: 'login', methods: ['POST'])]
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

        $user = Auth::user();

        return response()->json([
            'status' => 'success',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    #[Route('/api/register', name: 'register', methods: ['POST'])]
    public function register(Request $request): JsonResponse
    {
        $request->validate([
            'login' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $this->userAdapter->create(
            $request->get('login'),
            $request->get('email'),
            $request->get('password')
        );

        $user = $this->userAdapter->getByEmail($request->get('email'));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    #[Route('/api/logout', name: 'logout', methods: ['POST'])]
    public function logout(): JsonResponse
    {
        Auth::logout();

        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }

    #[Route('/api/refresh', name: 'refresh', methods: ['POST'])]
    public function refresh(): JsonResponse
    {
        $user = Auth::user();

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
