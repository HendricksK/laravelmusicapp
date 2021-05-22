<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AudioDbTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_search() {
        $response = $this->get('/api/audiodb/search?q=j%20cole');

        $response->assertStatus(200);
    }
}
