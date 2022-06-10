<?php

namespace Tests\Unit;

//use PHPUnit\Framework\TestCase;
//use Illuminate\Foundation\Testing\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    //bez ove funkcije import ne radi
    //public function createApplication(){
        
   // }

    public function testLoginTrue()
    {
        $credentials = [
            'Username' => 'mica',
            'Password' => 'mica123'
        ];
        $response = $this->post('login', $credentials)->assertRedirect('/');

        
    }
}
