<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Controllers;

use Illuminate\Http\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/health-check', name: 'health_check', methods: ['GET'])]
final class HealthCheckActionController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse(['status' => 'ok']);
    }
}
