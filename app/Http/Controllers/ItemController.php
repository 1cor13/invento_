<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $title = 'Inventory Listing';

        return view('item.index', compact('title','item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = ['Avon','Bridgestone','Continental','Dunlop','Firestone','Goodyear','Hankook','Michelin','Pirelli','Uniroyal','Yokohama']; // Brand::all();
        $item = new Item();

        return view('item.create', compact('brands', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize('create', Item::class);
        $item = Item::create($this->validateRequest());

        return redirect('item')
            ->with('success', 'Inventory item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('item.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $brands = ['Avon','Bridgestone','Continental','Dunlop','Firestone','Goodyear','Hankook','Michelin','Pirelli','Uniroyal','Yokohama'];
        return view('item.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Item $item)
    {
        $item->update($this->validateRequest());

        return redirect('item')->with('success', 'Item saved successfully');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        $this->authorize('destroy', Item::class);

        $result = $item->delete();
        $result = $result? (object)['status'=>'success', 'message'=>'Item successfully deleted'] : (object)['status'=>'error', 'message'=>'Failed to delete item'];

        return redirect('item')->with($result->status,$result->message);
    }

    private function validateRequest() {
        return request()->validate([
            'code' => 'required|min:3',
            'size' => 'required',
            'brand' => 'required',
            'quantity' => 'numeric|required',
            'minimum_quantity' => 'gt:0',
            'saleable' => 'boolean',
            'price' => 'numeric|required'
        ]);
    }
}
