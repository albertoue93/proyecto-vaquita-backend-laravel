<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class routeModuleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function animalCreate()
    {
        $response = $this->get('/animal/create');

        $response->assertStatus(200);
    }
     /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStore()
    {
        $response = $this->get('/animal/store');

        $response->assertStatus(200);
    }
}
