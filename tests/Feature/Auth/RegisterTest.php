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
        $this->postJson(route('user.register'),['name'=>'Mohamed','email'=>'mohamed@gmail.com','password'=>'Basiony1234'])
            ->assertCreated();

        $this->assertDatabaseHas('users',['name'=>'Mohamed','email'=>'mohamed@gmail.com','password'=>'Basiony1234']);

    }
}
