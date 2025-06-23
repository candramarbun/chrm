<?php

namespace App\Http\Controllers;
use App\Inventory;
use App\InventoryCategory;
use App\InventoryLocation;
use App\Supplier;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index()
    {
        $halaman = 'inventory';
        $inventories = Inventory::with(['category', 'location'])->get();
        return view('inventory.index', compact('inventories', 'halaman'));
    }

    public function create()
    {
        $halaman = 'inventory';
        $categories = InventoryCategory::all();
        $locations = InventoryLocation::all();
        $suppliers = Supplier::all();
        return view('inventory.create', compact('categories', 'locations', 'suppliers', 'halaman'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventories',
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'category_id' => 'required|exists:inventory_categories,id',
            'location_id' => 'required|exists:inventory_locations,id',
            'supplier_id' => 'nullable|exists:suppliers,id',
        ]);

        Inventory::create($request->all());
        return redirect()->route('inventory_index')->with('message', 'Inventory created successfully');
    }

    public function edit($id)
    {
        $halaman = 'inventory';
        $inventory = Inventory::findOrFail($id);
        $categories = InventoryCategory::all();
        $locations = InventoryLocation::all();
        $suppliers = Supplier::all();
        return view('inventory.edit', compact('inventory', 'categories', 'locations', 'suppliers', 'halaman'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventories,code,'.$id,
            'quantity' => 'required|numeric',
            'unit_price' => 'required|numeric',
            'category_id' => 'required|exists:inventory_categories,id',
            'location_id' => 'required|exists:inventory_locations,id'
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());
        return redirect()->route('inventory_index')->with('message', 'Inventory updated successfully');
    }

    public function destroy($id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();
        return redirect()->route('inventory_index')->with('message', 'Inventory deleted successfully');
    }
}
