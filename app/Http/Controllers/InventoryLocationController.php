<?php

namespace App\Http\Controllers;

use App\InventoryLocation;
use Illuminate\Http\Request;

class InventoryLocationController extends Controller
{
    public function index()
    {
        $halaman = 'inventory';
        $locations = InventoryLocation::all();
        return view('inventory.locations.index', compact('locations', 'halaman'));
    }

    public function create()
    {
        $halaman = 'inventory';
        return view('inventory.locations.create', compact('halaman'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventory_locations'
        ]);

        InventoryLocation::create($request->all());
        return redirect()->route('inventory_locations.index')
            ->with('message', 'Location created successfully');
    }

    public function edit($id)
    {
        $halaman = 'inventory';
        $location = InventoryLocation::findOrFail($id);
        return view('inventory.locations.edit', compact('location', 'halaman'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventory_locations,code,'.$id
        ]);

        $location = InventoryLocation::findOrFail($id);
        $location->update($request->all());
        return redirect()->route('inventory_locations.index')
            ->with('message', 'Location updated successfully');
    }

    public function destroy($id)
    {
        $location = InventoryLocation::findOrFail($id);
        $location->delete();
        return redirect()->route('inventory_locations.index')
            ->with('message', 'Location deleted successfully');
    }
}
