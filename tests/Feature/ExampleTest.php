<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

use Illuminate\Foundation\Testing\DatabaseMigrations;
class ExampleTest extends TestCase
{
    use DatabaseMigrations;
    // use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        // $response = $this->get('/');

        // $response->assertStatus(200);   

        $user = factory(User::class)->create(['password' => Hash::make($password = 'password')]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }
}
