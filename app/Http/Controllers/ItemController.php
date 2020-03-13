<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Item::class, 'item');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // apply pagnation.
        $items = Item::paginate(15);
        $title = 'Inventory Listing';

        return view('items.index', compact('title','items'));
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

        return view('items.create', compact('brands', 'item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validItem = $this->validateRequest();
        $item = Item::create($this->generatedAttributes($validItem));
;
        return redirect('items')
            ->with([
                'success' => 'Item saved successfully',
                'item' =>$item
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        return view('items.show', compact('item'));
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
        return view('items.edit', compact('item', 'brands'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        $validItem = $this->validateRequest();
        $item->update($this->generatedAttributes($validItem));

        return redirect('items')
            ->with([
                'success' => 'Item saved successfully',
                'item' => $item
            ]);
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        // $this->authorize('destroy', Item::class);

        $result = $item->delete();
        $result = $result? (object)['status'=>'success', 'message'=>'Item successfully deleted'] : (object)['status'=>'error', 'message'=>'Failed to delete item'];

        return redirect('items')->with($result->status, $result->message);
    }

    private function validateRequest() {
        return request()->validate([
            'code' => 'required|min:3',
            'size' => 'required',
            'brand' => 'required',
            'quantity' => 'numeric|required|gt:minimum_quantity',
            'minimum_quantity' => 'required|numeric',
            'saleable' => 'boolean',
            'price' => 'numeric|required'
        ]);
    }

    private function generatedAttributes(array $validItem) {
        $item = (object) $validItem;
        $validItem['name'] = $this->generateItemName($item->size, $item->code, $item->brand);
        $validItem['saleable'] = $item->saleable ?? false;

        return $validItem;
    }

    private function generateItemName(string $size, string $code, string $brand) {
        return "{$size} {$code} {$brand}";
    }
}
