<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $user = factory(User::class)->create();

        $posts = $user->posts()->saveMany(factory(Post::class, 2)->make());

        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertSee($posts->first()->title)
            ->assertSee($posts->last()->title);
    }

    public function testAbout()
    {
        $response = $this->get('/about');

        $response->assertStatus(200);
    }

    public function testRss()
    {
        $response = $this->get('/rss');

        $response->assertStatus(200);
    }
}
