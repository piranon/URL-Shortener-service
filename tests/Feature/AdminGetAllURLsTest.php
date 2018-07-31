<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminGetAllURLsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp()
    {
        parent::setUp();
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
        $response = $this->json('GET', 'admin/urls');
        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'code',
                'url',
                'status',
                'hits',
                'create_at',
                'update_at',
                'expire_in'
            ]);
    }
}
