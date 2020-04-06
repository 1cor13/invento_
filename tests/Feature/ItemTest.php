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
    // // use RefreshDatabase;
    use DatabaseMigrations;

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
        $user = factory(User::class)->create();
        $user->roles()->save(Role::create(['name' => 'dataentrant']));
        $item = factory(Item::class)->make();
        $response = $this->actingAs($user)->post('items', $item->toArray());
        $response->assertRedirect('/items');
        $response->assertSessionHas('success', 'Item saved successfully');
    }

    public function testAddInventoryAsManager() {
        // manager is authorized by policy;
        $user = factory(User::class)->create();
        $user->roles()->save(Role::create(['name' => 'manager']));
        $item = factory(Item::class)->make();
        $response = $this->actingAs($user)->post('items', $item->toArray());
        $response->assertRedirect('/items');
        $response->assertSessionHas('success', 'Item saved successfully');
    }

    public function testAddInventoryAsAdmin() {
        // admin blocked by policy
        $admin = factory(User::class)->create();
        $admin->roles()->save(Role::create(['name' => 'admin']));
        $item = factory(Item::class)->make();
        $response = $this->actingAs($admin)->post('items', $item->toArray());
        $response->assertStatus(403); 
    }

    public function testDeletingItemAsDataEntrant() {
        factory(Item::class,5)->create();
        $user = factory(User::class)->create();
        $user->roles()->save(Role::create(['name' => 'dataentrant']));
        
        $item = Item::all()->random();
        $response = $this->actingAs($user)->delete("items/{$item->id}");
        $response->assertStatus(403); // un authorized operation for dataentrant

        // manager can delete
        $user = factory(User::class)->create();
        $user->roles()->save(Role::create(['name' => 'manager'])); 
        $item = Item::all()->random();
        $response = $this->actingAs($user)->delete("items/{$item->id}");
        $response->assertRedirect('items')
            ->assertSessionHas('success', 'Item successfully deleted');             
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
