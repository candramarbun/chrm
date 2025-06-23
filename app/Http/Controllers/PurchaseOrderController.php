<?php

namespace App\Http\Controllers;
use App\PurchaseOrder;
use App\Supplier;
use App\Inventory;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $halaman = 'inventory';
        $purchaseOrders = PurchaseOrder::with('supplier')->get();
        return view('purchase_orders.index', compact('purchaseOrders', 'halaman'));
    }

    public function create()
    {
        $halaman = 'inventory';
        $suppliers = Supplier::all();
        $inventories = Inventory::all();
        return view('purchase_orders.create', compact('suppliers', 'inventories', 'halaman'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'order_number' => 'required|unique:purchase_orders',
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $purchaseOrder = PurchaseOrder::create($request->only(['order_number', 'supplier_id', 'order_date', 'expected_delivery_date', 'notes']));
        foreach ($request->items as $item) {
            $purchaseOrder->items()->create($item);
        }

        return redirect()->route('purchase_orders.index')->with('message', 'Purchase Order created successfully');
    }

    public function show($id)
{
    $purchaseOrder = PurchaseOrder::with('supplier', 'items.inventory')->findOrFail($id);
    return view('purchase_orders.show', compact('purchaseOrder'));
}

    public function edit($id)
    {
        $halaman = 'inventory';
        $purchaseOrder = PurchaseOrder::with('items')->findOrFail($id);
        $suppliers = Supplier::all();
        $inventories = Inventory::all();
        return view('purchase_orders.edit', compact('purchaseOrder', 'suppliers', 'inventories', 'halaman'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'order_number' => 'required|unique:purchase_orders,order_number,'.$id,
            'supplier_id' => 'required|exists:suppliers,id',
            'order_date' => 'required|date',
            'items.*.inventory_id' => 'required|exists:inventories,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0'
        ]);

        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->update($request->only(['order_number', 'supplier_id', 'order_date', 'expected_delivery_date', 'notes']));
        $purchaseOrder->items()->delete();
        foreach ($request->items as $item) {
            $purchaseOrder->items()->create($item);
        }

        return redirect()->route('purchase_orders.index')->with('message', 'Purchase Order updated successfully');
    }

    public function destroy($id)
    {
        $purchaseOrder = PurchaseOrder::findOrFail($id);
        $purchaseOrder->delete();
        return redirect()->route('purchase_orders.index')->with('message', 'Purchase Order deleted successfully');
    }
}
