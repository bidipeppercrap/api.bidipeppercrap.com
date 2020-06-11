<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Post;

class PostTest extends TestCase
{
    // use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testDatabase()
    {
        // $posts = factory(App\Post::class, 30)->make();
        return $this->assertTrue(true);
    }

    public function testStorePost()
    {
        return true;
    }
}
