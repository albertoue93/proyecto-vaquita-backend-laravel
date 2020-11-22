<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\User;
class loginTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function errorStatus()
    {
        $response = $this->get('/signin');
        $response->assertStatus(404);
    }
     /** @test */
     public function authenticated_to_a_user()
     {
         $this->get('/signin');
         $credentials = [
             "email" => "admin@gmail.com",
             "password" => "admin"
         ];
         $response = $this->post('/signin', $credentials);
         $this->assertCredentials($credentials);
     }
     
}
