<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{   public function index()
    {
        $products = Product::with('category')
        ->paginate(10);
        return view('home', compact('products'));
    }
    public function show(Product $product)
    {
        return view('front.products.show' , compact('product'));
    }
}
