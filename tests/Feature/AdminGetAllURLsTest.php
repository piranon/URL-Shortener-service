<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\URL;

class AdminGetAllURLsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
        auth()->login($user);
    }

    public function testNotFoundAnyURL()
    {
        $response = $this->json('GET', 'admin/urls');
        $response
            ->assertStatus(200)
            ->assertJson([]);
    }

    public function testGetListURLs()
    {
        factory(URL::class, 50)->create();
        $response = $this->json('GET', 'admin/urls');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([[
                'id',
                'code',
                'url',
                'hits',
                'status',
                'expires_in',
                'created_at',
                'updated_at',
            ]]);
    }
}
