<?php

use Tests\TestCase;

class HealthCheckActionTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function test_request_responded_successful_result(): void
    {
        $response = $this->get('/health-check');
        $response->assertStatus(200);

        $jsonResult = json_decode($response->content(), true, 512, JSON_THROW_ON_ERROR);
        $this->assertEquals('ok', $jsonResult['status']);
    }
}
