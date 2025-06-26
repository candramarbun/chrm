<?php

namespace App\Http\Controllers;

use App\Inventory;
use App\Customer;
use App\Sale;
use App\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PosController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $customers = Customer::all();
        return view('pos.index', compact('cart', 'customers'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Inventory::where('name', 'like', "%{$search}%")
            ->orWhere('code', 'like', "%{$search}%")
            ->select('id', 'name', 'code', 'sell_price as price', 'quantity') // Map sell_price to price
            ->get();
        
        return response()->json($products);
    }

    public function addToCart(Request $request)
    {
        $product = Inventory::select('id', 'name', 'code', 'sell_price as price')
            ->find($request->product_id);
        
        if(!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        $cart = session()->get('cart', []);
        
        if(isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
        } else {
            $cart[$product->id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,  // This will now be the sell_price
                "code" => $product->code
            ];
        }
        
        session()->put('cart', $cart);
        return response()->json($cart);
    }
    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            return response()->json($cart);
        }
        
        return response()->json(['error' => 'Item not found'], 404);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('cart');
        
        if(isset($cart[$request->id])) {
            unset($cart[$request->id]);
            session()->put('cart', $cart);
        }
        
        return response()->json($cart);
    }

    public function checkout(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'payment_method' => 'required|in:cash,card,transfer',
            'amount_paid' => 'required|numeric|min:0',
        ]);

        $cart = session()->get('cart', []);
        
        if(empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        // Create sale
        $sale = Sale::create([
            'invoice_number' => 'INV-' . time(),
            'customer_id' => $request->customer_id,
            'sale_date' => now(),
            'payment_method' => $request->payment_method,
            'amount_paid' => $request->amount_paid,
            'total_amount' => array_reduce($cart, function($carry, $item) {
                return $carry + ($item['price'] * $item['quantity']);
            }, 0),
        ]);

        // Create sale items
        foreach($cart as $item) {
            SaleItem::create([
                'sale_id' => $sale->id,
                'inventory_id' => $item['id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['price'],
            ]);

            // Update inventory
            $inventory = Inventory::find($item['id']);
            if($inventory) {
                $inventory->decrement('quantity', $item['quantity']);
            }
        }

        // Clear cart
        session()->forget('cart');

        return redirect()->route('sales.show', $sale->id)
            ->with('success', 'Sale completed successfully');
    }
}