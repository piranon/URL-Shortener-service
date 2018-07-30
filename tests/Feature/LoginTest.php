<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    public function testLoginValidationError()
    {
        $response = $this->json('POST', 'auth/login', []);
        $response
            ->assertStatus(400)
            ->assertJson([
                'username' => [
                    "A username is required"
                ],
                'password' => [
                    "A password is required"
                ],
            ]);
    }

    public function testLoginWithWrongPasswordError()
    {
        $response = $this->json('POST', 'auth/login', [
            'username' => 'admin',
            'password' => 'invalid_password'
        ]);
        $response
            ->assertStatus(401)
            ->assertJson([
                'error' => "Unauthorized"
            ]);
    }

    public function testLoginSuccess()
    {
        $response = $this->json('POST', 'auth/login', [
            'username' => 'admin',
            'password' => 'admin'
        ]);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'access_token'
            ]);
    }
}
