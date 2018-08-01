<?php

namespace Tests\Feature;

use App\Models\URL;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GetURLByCodeTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
    }

    public function testGetURLNotFound()
    {
        $response = $this->json('GET', 'urls/code');
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'URL not found'
            ]);
    }

    public function testGetURLNotSentCode()
    {
        $response = $this->json('GET', 'urls/');
        $response
            ->assertStatus(405)
            ->assertJson([
                'message' => 'Method not allowed'
            ]);
    }

    public function testGetActiveURLSuccess()
    {
        factory(URL::class, 50)->create();
        $url = URL::where('status', URL::STATUS_ACTIVE)->first();
        $response = $this->json('GET', 'urls/' . $url->code);
        $response
            ->assertStatus(200)
            ->assertJson([
                'url' => $url->url,
                'status' => $url->status
            ]);
    }

    public function testGetDeletedURLSuccess()
    {
        factory(URL::class, 50)->create();
        $url = URL::where('status', URL::STATUS_DELETED)->first();
        $response = $this->json('GET', 'urls/' . $url->code);
        $response
            ->assertStatus(200)
            ->assertJson([
                'url' => $url->url,
                'status' => $url->status
            ]);
    }

    public function testGetExpiredURLSuccess()
    {
        factory(URL::class, 50)->create();
        $url = URL::where('status', URL::STATUS_EXPIRED)->first();
        $response = $this->json('GET', 'urls/' . $url->code);
        $response
            ->assertStatus(200)
            ->assertJson([
                'url' => $url->url,
                'status' => $url->status
            ]);
    }
}
