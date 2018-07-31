<?php

namespace Tests\Feature;

use App\Models\URL;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSearchURLTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
        $user = factory(User::class)->create();
        auth()->login($user);
    }

    public function testSearchOnShortUrlFound()
    {
        factory(URL::class, 10)->create();
        $shortURLValue = 'test_search_on_short_url';
        $response = $this->json('GET', 'admin/urls/search?short_url=' . $shortURLValue);
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
            ]])
            ->assertSeeText($shortURLValue);
    }
}
