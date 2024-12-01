<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventory;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::all();
        return view('inventories.index', compact('inventories'));
    }

    public function create()
    {
        return view('inventories.create');
    }

    public function store(Request $request)
    {
        // バリデーションルールを追加
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $inventory = new Inventory();
        $inventory->product_name = $request->input('product_name');
        $inventory->quantity = $request->input('quantity');
        $inventory->price = $request->input('price');

        if ($request->hasfile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $inventory->product_image = $imagePath;
        }

        $inventory->save();

        return redirect()->route('inventories.index');
    }

    public function show($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.show', compact('inventory'));
    }

    public function edit($id)
    {
        $inventory = Inventory::findOrFail($id);
        return view('inventories.edit', compact('inventory'));
    }

    public function update(Request $request, $id)
    {
        // バリデーションルールを追加
        $request->validate([
            'product_name' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->product_name = $request->input('product_name');
        $inventory->quantity = $request->input('quantity');
        $inventory->price = $request->input('price');

        if ($request->hasfile('product_image')) {
            $imagePath = $request->file('product_image')->store('product_images', 'public');
            $inventory->product_image = $imagePath;
        }

        $inventory->save();

        return redirect()->route('inventories.index');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index');
    }
}
