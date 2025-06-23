<?php

namespace App\Http\Controllers;

use App\InventoryCategory;
use Illuminate\Http\Request;

class InventoryCategoryController extends Controller
{
    public function index()
    {
        $halaman = 'inventory';
        $categories = InventoryCategory::all();
        return view('inventory.categories.index', compact('categories', 'halaman'));
    }

    public function create()
    {
        $halaman = 'inventory';
        return view('inventory.categories.create', compact('halaman'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventory_categories'
        ]);

        InventoryCategory::create($request->all());
        return redirect()->route('inventory_categories.index')
            ->with('message', 'Category created successfully');
    }

    public function edit($id)
    {
        $halaman = 'inventory';
        $category = InventoryCategory::findOrFail($id);
        return view('inventory.categories.edit', compact('category', 'halaman'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:inventory_categories,code,'.$id
        ]);

        $category = InventoryCategory::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('inventory_categories.index')
            ->with('message', 'Category updated successfully');
    }

    public function destroy($id)
    {
        $category = InventoryCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('inventory_categories.index')
            ->with('message', 'Category deleted successfully');
    }
}
