<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LinkTest extends TestCase
{
    use RefreshDatabase;
    protected bool $seed = true;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_a_list_of_links_can_be_shown()
    {
        $response = $this->get('/api/links');

        $response->assertStatus(200);//->dump();
    }
}
