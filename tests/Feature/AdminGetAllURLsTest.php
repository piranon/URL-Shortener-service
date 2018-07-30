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
        $response = $this->json('GET', 'admin/urls', []);
        $response
            ->assertStatus(200)
            ->assertJson([]);
    }
}
