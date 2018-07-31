<?php

namespace Tests\Feature;

use App\Models\URL;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

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

    public function testDeleteURLButURLAlreadyDeleted()
    {
        factory(URL::class, 50)->create();
        $url = URL::where('status', URL::STATUS_DELETED)->first();
        $response = $this->json('DELETE', 'admin/urls/' . $url->id);
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'URL not found'
            ]);
    }

    public function testDeleteURLButURLAlreadyExpired()
    {
        factory(URL::class, 50)->create();
        $url = URL::where('status', URL::STATUS_EXPIRED)->first();
        $response = $this->json('DELETE', 'admin/urls/' . $url->id);
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'URL not found'
            ]);
    }
}
