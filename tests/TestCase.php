<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function userApiLogin($user = null)
    {
        $user = $user ? $user : User::factory()->create();

        Sanctum::actingAs(
            $user,
            ['*']
        );

        return $user;

    }

}
