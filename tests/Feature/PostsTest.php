<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
//        dd($this->authUser());
        $this->user = $this->authUser();
    }

    public function test_create_a_post()
    {
        $post = Post::factory()->make();

        $this->postJson(route('user.create-post'), [
            'title' => $post->title,
            'description' => $post->description,
            'publication_date' => $post->publication_date,
        ])
            ->assertCreated();

        $this->assertDatabaseHas('posts', [
            'title' => $post->title,
            'description' => $post->description,
            'publication_date' => $post->publication_date,
        ]);
    }
}
