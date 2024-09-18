<?php

namespace Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_login_with_email_and_password()
    {
        $response=$this->postJson(route('user.login'),[
            'email'=>'mohamed@gmail.com'
            ,'password'=>'password'])
        ->assertOk();

        $this->assertArrayHasKey('token',$response->json());
    }

    public function test_if_user_email_not_available_then_it_returns_error(){

        $this->postJson(route('user.login'),['email'=>'mohamed@gmail.com','password'=>'password'])
        ->assertUnauthorized();

    }
}
