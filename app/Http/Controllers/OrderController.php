<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get();
        $cartItems = session('cart', []);

        return view('order.index', compact('orders', 'cartItems'));
    }
    public function create()
    {
        $products = Product::get();
        $users = \App\Models\User::get();
        return view('order.create', compact('products', 'users'));
    }
    public function checkout()
    {
        $cartItems = session('cart', []);

        return view('checkout', compact('cartItems'));
    }

    public function store(Request $request)
    {
        // Logic for storing the order
        $items = $request->input('items', [
            'id' => 1,
            'name' => 'Product 1',
            'quantity' => 2,
            'price' => 19.99,
        ]);
        $order = Order::create([
            'order_number' => 'ORD-' . $request->order_number,
            'user_id' => auth()->id(),
            'items' => json_encode($items),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'payment_method' => $request->payment_method ?? 'cash',
        ]);
        session()->forget('cart');
        return redirect()->route('home')->with('booking_success', 'Your order #' . $order->order_number . ' has been placed successfully!');
    }
}
