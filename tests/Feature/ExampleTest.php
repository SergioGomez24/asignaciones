<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ExampleTest extends TestCase
{
     use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHome()
    {
        $this->withoutMiddleware();

        $response = $this->get('home');

        $response->assertStatus(200);
    }

    public function testSubjectsCreate()
    {
        $this->withoutMiddleware();

        $response = $this->get('subjects/create');

        $response->assertStatus(200);
    }

    /*public function testSubjectsCreatepost()
    {
        $this->withoutMiddleware();

        $response = $this->post('subjects/create');

        $response->assertStatus(200);
    }

    public function testSubjetsEdit()
    {
        $this->withoutMiddleware();

        $response = $this->get('subjects/edit/');

        $response->assertStatus(200);
    }*/

    public function testTeachers()
    {
        $this->withoutMiddleware();

        $response = $this->get('teachers');

        $response->assertStatus(200);
    }

    public function testTeachersCreate()
    {
        $this->withoutMiddleware();

        $response = $this->get('teachers/create');

        $response->assertStatus(200);
    }

    public function testElections()
    {
        $this->withoutMiddleware();

        $response = $this->get('elections');

        $response->assertStatus(200);
    }

}
