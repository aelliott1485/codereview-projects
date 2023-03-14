<?php

namespace Tests\Feature;

use App\Models\Link;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;
    /**
     * test fetching a list of links
     *
     * before making singleton:
     *
     * Time: 00:00.568, Memory: 32.00 MB
     * Time: 00:00.387, Memory: 32.00 MB
     * Time: 00:00.449, Memory: 32.00 MB
     *
     * @return void
     */
    public function test_a_list_of_links_can_be_shown()
    {
        $response = $this->get('/api/links');

        $response->assertStatus(200);
    }

    /**
     * test loading a single link
     * @return void
     */
    public function test_a_link_can_be_shown()
    {
        $firstLink = Link::first();
        $secondLink = Link::latest()->first();

        $response = $this->get("/api/links/{$firstLink->code}");
        $response->assertOk();

        $response = $this->get("/api/links/{$secondLink->code}");
        $response->assertOk();
    }

}
