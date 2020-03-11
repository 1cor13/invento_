<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Item;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class ItemTest extends TestCase
{
    use WithoutMiddleware;
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddItemToInventory()
    {
        $this->withoutExceptionHandling();
        $this->withoutMiddleware();
        $item = factory(Item::class)->make()->toArray();
        $response = $this->post('items',$item);

        $response->assertRedirect('/items');

        $this->assertCount(1, Item::all());
    }
}
