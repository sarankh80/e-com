<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
class HomeController extends Controller
{
    function index()
    {   
        $cartItems = session('cart', []);
        $products = Product::with('category')->get();
        $slides = Slide::where('is_active', true)->latest()->get();
        $categories = Category::get();
        return view('front', compact('categories','products', 'slides', 'cartItems'));
    }
}
