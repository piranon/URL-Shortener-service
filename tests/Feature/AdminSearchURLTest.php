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
        factory(URL::class, 50)->create();

        $shortURLValue = 'XXXXXXX';

        $url = URL::where('status', URL::STATUS_ACTIVE)->first();
        $url->code = $shortURLValue;
        $url->save();

        $response = $this->json('GET', 'admin/urls/search?code=' . $shortURLValue);
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
        $this->assertEquals(1, count($response->decodeResponseJson()));
    }

    public function testSearchOnShortUrlNotFound()
    {
        factory(URL::class, 50)->create();

        $shortURLValue = 'XXXXXXX';

        $response = $this->json('GET', 'admin/urls/search?code=' . $shortURLValue);
        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);
    }

    public function testSearchOnOriginalUrlFound()
    {
        factory(URL::class, 50)->create();

        $originalURLValue = 'www.test-search-on-original-url.com';

        $url = URL::where('status', URL::STATUS_ACTIVE)->first();
        $url->url = $originalURLValue;
        $url->save();

        $response = $this->json('GET', 'admin/urls/search?url=' . $originalURLValue);
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
            ->assertSeeText($originalURLValue);
        $this->assertEquals(1, count($response->decodeResponseJson()));
    }

    public function testSearchOnOriginalUrlAndWrongStatusStillFound()
    {
        factory(URL::class, 50)->create();

        $originalURLValue = 'www.test-search-on-original-url.com';

        $url = URL::where('status', URL::STATUS_ACTIVE)->first();
        $url->url = $originalURLValue;
        $url->save();

        $response = $this->json('GET', 'admin/urls/search?url=' . $originalURLValue . '&status=deleted');
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
            ->assertSeeText($originalURLValue);
        $this->assertEquals(1, count($response->decodeResponseJson()));
    }
}
