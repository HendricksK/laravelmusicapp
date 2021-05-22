<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class YoutubeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example() {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_search() {
        $response = $this->get('/api/youtube/search?q=j%20cole');

        $response->assertStatus(200);
    }

    public function test_search_track() {
        $response = $this->get('/api/youtube/search?q=j%20cole&type=track');

        $response->assertStatus(200);
    }
}
