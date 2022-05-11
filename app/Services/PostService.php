<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PostService
{
    // Create a new Post for user
    public function createPost(array $data) : Model
    {
        return Post::query()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'user_id' => auth()->id(),
            'publication_date' => $data['publication_date'],
        ]);
    }

    // Get single user post
    public function getUserPosts(string $sortBy)
    {
        // fetch all user post and sort by publication_date
//        return auth()->user()->posts()->orderBy('publication_date', $sortBy)->get();

        return \Cache::remember('posts', 60 * 30, function () use ($sortBy) {
            return auth()->user()->posts()->orderBy('publication_date', $sortBy)->get();
        });
    }

    // Get all posts
    public function getPosts(string $sortBy)
    {
        // fetch all posts and sort by publication_date
        return \Cache::remember('posts', 60 * 30, function () use ($sortBy) {
            return Post::query()
                ->orderBy('publication_date', $sortBy)
                ->get();
        });
    }

    // Create multiple posts for admin user
    public function importMultiplePosts($data) : bool
    {
        // get admin User
        $adminUser = User::query()->where('is_admin', true)->first();

        // import multiple posts for admin user
        collect($data)->each(function ($post) use ($adminUser) {
            Post::query()->create([
                'title' => $post['title'],
                'description' => $post['description'],
                'user_id' => $adminUser->id,
                'publication_date' => $post['publication_date'],
            ]);
        });

        return true;
    }
}
