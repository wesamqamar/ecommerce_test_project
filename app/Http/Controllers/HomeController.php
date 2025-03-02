<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{   public function index()
    {
        $products = Product::paginate(10); // 10 منتجات لكل صفحة
        return view('home', compact('products'));
    }
    public function show(Product $product)
    {
        return view('front.products.show' , compact('product'));
    }
}
