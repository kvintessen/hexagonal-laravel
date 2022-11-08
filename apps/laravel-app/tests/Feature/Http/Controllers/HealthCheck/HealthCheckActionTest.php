<?php

declare(strict_types=1);

namespace Apps\LaravelApp\Tests\Feature\Http\Controllers\HealthCheck;

use Apps\LaravelApp\Tests\TestCase;
use JsonException;

class HealthCheckActionTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_request_responded_successful_result(): void
    {
        //act
        $response = $this->get('/health-check');
        //assert
        $response->assertStatus(200);

        //act
        $jsonResult = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);
        //assert
        $this->assertEquals('ok', $jsonResult['status']);
    }
}
