<?php

namespace Tests\Feature\API;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_register_a_user()
    {

        $response = $this->post('api/register', [
            'name' => 'jane doe',
            'email' => 'user@user.com',
            'phone' => '0114949905',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'jane doe',
            'email' => 'user@user.com',
            'phone' => '0114949905',
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function user_can_update_profile()
    {

        $user = $this->userApiLogin();

        $response = $this->put('api/profile', [
            'name' => 'jane doe',
            'email' => 'user@user.com',
            'phone' => '0114949905',
        ]);

        $this->assertDatabaseHas('users', [
            'name' => 'jane doe',
            'email' => 'user@user.com',
            'phone' => '0114949905',
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_login()
    {

        $this->withoutExceptionHandling();

        $user = User::factory()->create([
            'email' => 'user@user.com'
        ]);

        $this->userApiLogin($user);

        $response = $this->post('api/login', [
            'identity' => 'user@user.com',
            'password' => 'password',
        ]);

        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_logout_and_delete_his_token()
    {

        $this->withoutExceptionHandling();

        $user = $this->userApiLogin();

        $user->createToken('user-application');

        $this->post('/api/logout');

        $this->assertCount(0, $user->tokens);

    }

}


