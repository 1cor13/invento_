<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreateOrder()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function testRaiseErrorWhenOrderQuantityIsMoreThanInventoryQuantity() {
        //
    }

    public function testReduceItemInventoryOnOrderUsingOrderObservable() {
        //
    }

    
}
