<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Hamcrest\Core\IsTypeOf;
use Tests\Feature\Auth;
use Tests\TestCase;
use App\Customer;
use App\User;
use App\Role;
use App\Item;
use App\ItemOrderPivot;
use App\Order;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class OrderTest extends TestCase
{
    // use RefreshDatabase;
    // use WithoutMiddleware;

    // use DatabaseTransactions;
    use DatabaseMigrations;
    var $customer; var $user; var $manager;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateOrder()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        // $this->artisan("db:seed");       
        
        $this->setupUsers();        
        $item = factory(Item::class)->create();
        dump($item->quantity);
        $itemOrderPivot = new ItemOrderPivot([
            'item_id' => $item->id,
            'quantity' => 1,
            'price' => $item->price,
        ]);
        $data = [
            'item_orders' => [$itemOrderPivot->toArray()],
            'customer_id' => $this->customer->id,
        ];


        $response = $this->actingAs($this->user)
            ->session(['foo' => 'bar'])
            ->post('orders', $data);

        $response->assertStatus(200);
        sleep(3);
        $dbItem = Item::find($item->id);
        dump($item->quantity);
        dump($dbItem->quantity);
        $this->assertEquals($item->quantity - 1, $dbItem->quantity);
    }

    // public function testRaiseErrorWhenOrderQuantityIsMoreThanInventoryQuantity() {
    //     dump(User::find(1));
    // }

    // public function testReduceItemInventoryOnOrderUsingOrderObservable() {
    //     $this->withoutExceptionHandling();
    //     $this->withoutMiddleware();
    //     // $this->artisan("db:seed");
    
    //     $item = factory(Item::class)->create(['quantity' => 20, 'minimum_quantity' => 10]);
        
    //     $itemOrderPivot = new ItemOrderPivot([
    //         'item_id' => $item->id,
    //         'quantity' => 11,
    //         'price' => $item->price,
    //     ]);
    //     $data = [
    //         'item_orders' => [$itemOrderPivot->toArray()],
    //         'customer_id' => $this->customer->id,
    //     ];

    //     // $user = User::find(1); // data entrant user;

    //     $response = $this->actingAs($this->user)
    //         ->session(['foo' => 'bar'])
    //         ->post('/orders', $data);
    //     $response->assertStatus(200);
        
    //     $newQuantity = Item::find($item->id)->quantity;
    //     assertEquals(9, $newQuantity);
    // }

    // public function testSendEmailToManagerOnDepletion() {
    //     //

    // }

    private function setupUsers() {
        $this->user = factory(User::class)->create();
        $this->user->roles()->save(Role::create(['name' => 'dataentrant'])); // data entrant user;

        $this->manager = factory(User::class)->create(['email' => 'joannakwagala@gmail.com']);
        $this->manager->roles()->save(Role::create(['name' => 'manager']));
        
        $this->customer = factory(Customer::class)->create();
    }
    
}
