<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Sanctum\Sanctum;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    protected function createUser(array $attributes = [], $abilities = ['*'])
    {
        $user = User::factory()->create($attributes);
        Sanctum::actingAs($user, $abilities);
        return $user;
    }
}