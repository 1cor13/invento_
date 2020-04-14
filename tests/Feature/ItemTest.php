<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Item;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Session;

class ItemTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;
    // use DatabaseMigrations;
    var $dataentrant; var $manager; var $admin;

    public function setUp() :void {
        parent::setUp();
        $this->user = factory(User::class)->create();
        $this->user->roles()->save(Role::create(['name' => 'dataentrant'])); // data entrant user;

        $this->manager = factory(User::class)->create();
        $this->manager->roles()->save(Role::create(['name' => 'manager']));

        $this->admin = factory(User::class)->create();
        $this->admin->roles()->save(Role::create(['name' => 'admin']));

        $user = factory(User::class)->create(['password' => bcrypt($password = 'password')]);
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => $password
        ]);
        $response->assertRedirect('/home');
        $this->assertAuthenticatedAs($user);
    }

    // /**
    //  * A basic test example.
    //  *
    //  * @return void
    //  */
    public function testAddItemToInventory()
    {
        $this->withoutExceptionHandling();
        // $this->refreshDatabase();
        $this->withoutMiddleware();
        $this->setUpUsers();
        $item = factory(Item::class)->make()->toArray();
        // dump($item);
        $response = $this->post('items',$item);

        $response
            ->assertRedirect('/items')         
            ->assertSessionHas('success', 'Item saved successfully');
    }

    public function testAddInventoryAsGuest() {
        $item = factory(Item::class)->make();        
        // guest is unauthorized and blocked by policy;
        $response = $this->post('items',$item->toArray());
        $response->assertStatus(403); 
    }

    public function testAddInventoryAsDataEntrant() {
        // dataentrant is authorized by policy;
        $item = factory(Item::class)->make();
        $response = $this->actingAs($this->dataentrant)->post('items', $item->toArray());
        $response->assertRedirect('/items');
        $response->assertSessionHas('success', 'Item saved successfully');
    }

    public function testAddInventoryAsManager() {
        // manager is authorized by policy;
        $item = factory(Item::class)->make();
        $response = $this->actingAs($this->manager)->post('items', $item->toArray());
        $response->assertRedirect('/items');
        $response->assertSessionHas('success', 'Item saved successfully');
    }

    public function testAddInventoryAsAdmin() {
        // admin blocked by policy
        $item = factory(Item::class)->make();
        $response = $this->actingAs($this->admin)->post('items', $item->toArray());
        $response->assertStatus(403); 
    }

    public function testDeletingItemAsDataEntrant() {
        factory(Item::class,5)->create();
        $item = Item::all()->random();
        
        // un authorized operation for dataentrant
        $response = $this->actingAs($this->dataentrant)->delete("items/{$item->id}");
        $response->assertStatus(403);

        // manager can delete
        $item = Item::all()->random();
        $response = $this->actingAs($this->manager)->delete("items/{$item->id}");
        $response->assertRedirect('items')
            ->assertSessionHas('success', 'Item successfully deleted');             
    }

    private function setupUsers() {
        $this->user = factory(User::class)->create();
        $this->user->roles()->save(Role::create(['name' => 'dataentrant'])); // data entrant user;

        $this->manager = factory(User::class)->create();
        $this->manager->roles()->save(Role::create(['name' => 'manager']));

        $this->admin = factory(User::class)->create();
        $this->admin->roles()->save(Role::create(['name' => 'admin']));
    }
    // public function testSoftDeleteItemAsManager() {
    //     //
    // }

    // public function testForceDeleteAsAdmin() {
    //     //
    // }

    // public function testSendManagerEmailNotificationWhenQuantityIsLessOrEqualToMinimumQuantity() {
    //     //
    // }
    
}
