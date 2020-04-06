<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    // public function testLogin()
    // {
    //     $response = $this->get('/');

    //     $response->assertStatus(200);
    // }

    // public function testLoginAsAdmin() {
    //     //
    // }

    // public function testRedirectToItemsOnLogin() {
    //     //
    // }

    // public function testInitiallyRedirectUserToLoginPage() {
    //     //
    // }
    public function testBasicTest3()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
