<?php

declare(strict_types=1);

namespace Apps\LaravelApp\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

final class HealthCheckActionController extends Controller
{
    #[Route('/health-check', name: 'health_check', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
