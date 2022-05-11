<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email_and_password()
    {
        $user = $this->createUser();

        $response = $this->postJson(route('login'),[
            'email' => $user->email,
            'password' => 'admin'
        ])
            ->assertOk();

        $this->assertArrayHasKey('data',$response->json());
    }

}
