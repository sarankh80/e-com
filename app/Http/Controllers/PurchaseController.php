<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
class PurchaseController extends Controller
{
    function index()
    {
        $purchases = Purchase::with('product', 'user')->get();
        return view('purchase.index', compact('purchases'));
    }
}
