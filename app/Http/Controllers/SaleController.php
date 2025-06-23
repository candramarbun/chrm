<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Customer;
use App\Inventory;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::with('customer')->get();
        return view('sales.index', compact('sales'));
    }

    public function create()
    {
        $customers = Customer::all();
        $inventories = Inventory::all();
        return view('sales.create', compact('customers', 'inventories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'invoice_number' => 'required|unique:sales',
            'customer_id' => 'required|exists:customer,id',
            'sale_date' => 'required|date',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $sale = Sale::create($request->only(['invoice_number', 'customer_id', 'sale_date']));
        foreach ($request->items as $item) {
            $sale->items()->create($item);
        }

        return redirect()->route('sales.index')->with('message', 'Sale created successfully');
    }

    public function edit($id)
    {
        $sale = Sale::with('items')->findOrFail($id);
        $customers = Customer::all();
        $inventories = Inventory::all();
        return view('sales.edit', compact('sale', 'customers', 'inventories'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'invoice_number' => 'required|unique:sales,invoice_number,'.$id,
            'customer_id' => 'required|exists:customers,id',
            'sale_date' => 'required|date',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $sale = Sale::findOrFail($id);
        $sale->update($request->only(['invoice_number', 'customer_id', 'sale_date']));
        $sale->items()->delete();
        foreach ($request->items as $item) {
            $sale->items()->create($item);
        }

        return redirect()->route('sales.index')->with('message', 'Sale updated successfully');
    }

    public function destroy($id)
    {
        $sale = Sale::findOrFail($id);
        $sale->delete();
        return redirect()->route('sales.index')->with('message', 'Sale deleted successfully');
    }
}
