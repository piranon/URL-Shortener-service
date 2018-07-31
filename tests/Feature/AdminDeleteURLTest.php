<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminDeleteURLTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
        auth()->login($user);
    }

    public function testDeleteURLNotFound()
    {
        $response = $this->json('DELETE', 'admin/urls/99');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'URL not found'
            ]);
    }

    public function testDeleteURLNotSentID()
    {
        $response = $this->json('DELETE', 'admin/urls/');
        $response
            ->assertStatus(405)
            ->assertJson([
                'message' => 'Method not allowed'
            ]);
    }
}
