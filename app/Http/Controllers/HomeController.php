<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
class HomeController extends Controller
{
    function index()
    {
        $products = Product::with('category')->get();

        $categories = Category::latest()->get();
        return view('front', compact('categories','products'));
    }
}
