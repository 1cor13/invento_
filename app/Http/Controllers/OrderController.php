<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Apply authentication policy as middleware
     */
    public function __construct() {
        $this->authorizeResource(Order::class, 'order');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::paginate(15);
        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $order = new Order();

       return view('orders.create', compact('order'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $items = collect($request->item_orders);
        $itemsWithPivot = $items->mapWithKeys(function($item) {     
            $itemRaw = Item::findOrFail($item['item_id']);
            return [
                $item['item_id'] => [
                    'quantity' => $item['quantity'],
                    'price' => $itemRaw->price * $item['quantity']
                ]
            ];
        })->all();

        $order = Order::updateOrCreate([
            'order_number' => rand(),
            'customer_id' => $request->customer_id,
            'user_id' => auth()->user()->id,
        ]);
        $order->items()->attach($itemsWithPivot);
        $order->save();
    
        // add an observer to ItemOrderPivot to fire events like is inventory quantity sufficient or not so an order can be stopped or a notification sent to manager incase the inventory is less than min
        
        return response()->json($order->toArray());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->update($this->validateRequest());

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {

    }

    private function validateRequest() {
        return request()->validate([
            'order_number' => 'required|unique:orders,order_number',
            'subtotal' => 'required|gt:0',
            'customer_id' => 'required',
            'user_id' => 'required'
        ]);
    }

    private function forceDelete(Order $order) 
    {
        $order->forceDelete();
    }
}
