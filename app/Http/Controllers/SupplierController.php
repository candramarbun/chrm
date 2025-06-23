<?php

namespace App\Http\Controllers;

use App\Supplier;use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index()
    {
        $halaman = 'inventory';
        $suppliers = Supplier::all();
        return view('inventory.suppliers.index', compact('suppliers', 'halaman'));
    }

    public function create()
    {
        $halaman = 'inventory';
        return view('inventory.suppliers.create', compact('halaman'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:suppliers',
            'email' => 'nullable|email',
            'phone' => 'nullable'
        ]);

        Supplier::create($request->all());
        return redirect()->route('inventory_suppliers.index')
            ->with('message', 'Supplier created successfully');
    }

    public function edit($id)
    {
        $halaman = 'inventory';
        $supplier = Supplier::findOrFail($id);
        return view('inventory.suppliers.edit', compact('supplier', 'halaman'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'code' => 'required|unique:suppliers,code,'.$id,
            'email' => 'nullable|email',
            'phone' => 'nullable'
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());
        return redirect()->route('inventory_suppliers.index')
            ->with('message', 'Supplier updated successfully');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        return redirect()->route('inventory_suppliers.index')
            ->with('message', 'Supplier deleted successfully');
    }
}
