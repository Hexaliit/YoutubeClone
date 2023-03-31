<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UsersTest extends TestCase
{
    /**
     * @test
     */
    public function a_user_can_register()
    {
        $response = $this->withoutExceptionHandling()->postJson('/api/register',[
            'name' => 'ali',
            'email' => 'ali@ali.ali',
            'password' => 'ali',
            'c_password' => 'ali',
        ]);
        $response->assertStatus(200);
    }

    /**
     * @test
     */
    public function a_user_can_login(){
        $response = $this->postJson('/api/login',[
            'name' => 'ali',
            'email' => 'ali@ali.ali',
            'password' => 'ali',
            'c_password' => 'ali',
        ]);
        $response->assertStatus(200);
    }
}
