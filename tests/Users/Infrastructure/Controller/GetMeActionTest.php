<?php

declare(strict_types=1);

namespace Tests\Users\Infrastructure\Controller;

use JsonException;
use Tests\Users\Domain\Entity\UserEntityMother;
use Tests\Users\Infrastructure\UserModuleUnitTestCase;

class GetMeActionTest extends UserModuleUnitTestCase
{
    /**
     * @throws JsonException
     */
    public function test_get_me_action(): void
    {
        $userEntity = UserEntityMother::create();

        $registerResponse = $this->withHeaders([
        ])->post('/api/register', [
            'uuid'     => $userEntity->getUuid()->value(),
            'login'    => $userEntity->getLogin()->value(),
            'email'    => $userEntity->getEmail()->value(),
            'password' => $userEntity->getPassword()->value(),
        ]);

        $loginResponse = $this->withHeaders([
        ])->post('/api/login', [
            'email'    => $userEntity->getEmail()->value(),
            'password' => $userEntity->getPassword()->value(),
        ])->withHeaders([
            'Content-Type' => 'application/json',
        ]);

        $jsonResult = json_decode($loginResponse->content(), false, 512, JSON_THROW_ON_ERROR);

        $this->assertEquals($userEntity->getEmail()->value(), $jsonResult->user->email);
    }
}
