<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Item;
// use App\Role;
// use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ItemTest extends TestCase
{
    // use WithoutMiddleware;
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddItemToInventory()
    {
        $this->withoutExceptionHandling();
        // $this->refreshDatabase();
        $this->withoutMiddleware();
        $item = factory(Item::class)->make()->toArray();
        $response = $this->post('items',$item);

        $response
            ->assertRedirect('/items')         
            ->assertSessionHas('success', 'Item saved successfully');
    }

    // public function testAddCustomNameAttribute() {
    //     // $this->withoutMiddleware();
    //     $user = factory(User::class)->create();
    //     $dataEntryRole = factory(Role::class)->make([
    //         'name' => 'dataentrant'
    //     ]);
    //     $user->roles()->syncWithoutDetaching($dataEntryRole);
    //     $user->push();
    //     $item = factory(Item::class)->make();
    //     $response = $this->post('items',$item);
    //     $response->assertUnauthorized();

    //     $response = $this->actingAs($user)->post('items', $item->toArray());
    //     $response->assertRedirect('/items');
        
    //     $response = $this->post('items', $item->toArray());
    //     dump($response->requ);
    //     dump(User::all());
    //     $response
    //         ->assertOk()
    //         ->assertJson([
    //             'name' => "{$size} {$code} {$brand}"
    //         ]);
    // }

    public function testAddItemAsDataEntrant() {
        //
    }

    public function testDeletingItemAsDataEntrant() {
        //
    }

    public function testSoftDeleteItemAsManager() {
        //
    }

    public function testForceDeleteAsAdmin() {
        //
    }

    public function testSendManagerEmailNotificationWhenQuantityIsLessOrEqualToMinimumQuantity() {
        //
    }
}
