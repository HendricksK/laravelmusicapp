<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpotifyTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_init()
    {
        $response = $this->get('/api/spotify/init');

        $response->assertStatus(200);
    }

    public function test_search()
    {
        $response = $this->get('/api/spotify/search?q=j%20cole');

        $response->assertStatus(200);
    }

    public function test_search_track()
    {
        $response = $this->get('/api/spotify/search?q=j%20cole&type=track');

        $response->assertStatus(200);
    }

}
