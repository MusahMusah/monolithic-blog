<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_register()
    {

        $this->postJson(route('register'),[
            'name' => "Musah Musah",
            'email' => 'musahmusah@mail.com',
            'password' => 'musahmusah',
            'password_confirmation' => 'musahmusah',
        ])->assertCreated();

        $this->assertDatabaseHas('users',['name' => 'Musah Musah']);
    }
}
