<?php

namespace Tests\Feature;

use App\Models\Link;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;
    /**
     * test fetching a list of links
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

        $response = $this->get("/api/links/{$firstLink->code}");
        $response->assertStatus(200);
    }

}
