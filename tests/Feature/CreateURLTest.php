<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateURLTest extends TestCase
{
    public function testCreateWithNoExpireDateURL()
    {
        $data = ['url' => 'https://www.google.co.th'];
        $response = $this->json('POST', '/urls', $data);
        $response
            ->assertStatus(201)
            ->assertJson([
                'success' => true,
            ]);
        $this->assertDatabaseHas('url', $data);
    }
}
