<?php

namespace App\Http\Controllers;

use App\InventoryItem;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inventory = InventoryItem::all();
        $title = 'Inventory Listing';

        return view('inventory.index', compact('title','inventory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $inventoryItem = $this->updateItem($request, null);
        $inventoryItem->save();

        return redirect('inventory')
            ->with('success', 'Inventory item stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inventory = InventoryItem::findOrFail($id);
        return view('inventory.show', compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inventory = InventoryItem::find($id);

        return view('inventory.edit', compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inventory = $this->updateItem($request, $id);
        $inventory->save();

        return redirect('inventory')->with('success', 'Item saved successfully');
    }
    
        /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \App\InventoryItem
     */
    private function updateItem(Request $request, $id) {
        $inventoryItem = InventoryItem::findorNew($id);
        $inventoryItem->code = $request->code;
        $inventoryItem->size = $request->size;
        $inventoryItem->brand = $request->brand;
        $inventoryItem->quantity = $request->quantity;
        $inventoryItem->minimum_quantity = $request->minimum_quantity;
        $inventoryItem->price = $request->price;
        $inventoryItem->saleable = $request->saleable ?? false;
        $inventoryItem->name = $inventoryItem->getItemName();
        $inventoryItem->description = $request->description;

        return $inventoryItem;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = InventoryItem::destroy($id);
        $result = $result? (object)['status'=>'success', 'message'=>'Item successfully deleted'] : (object)['status'=>'error', 'message'=>'Failed to delete item'];

        return redirect('inventory')->with($result->status,$result->message);
    }
}
