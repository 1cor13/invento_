<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\User;

class UserTest extends TestCase
{
    use RefreshDatabase;
    // /**
    //  * A basic feature test example.
    //  *
    //  * @return void
    //  */
    public function testLogin()
    {
        $user = factory(User::class)->create(['password' => bcrypt($password = 'password')]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

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
