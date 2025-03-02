<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10); // 10 منتجات لكل صفحة
        return view('home', compact('products'));
    }
    public function show(Product $product)
    {
        return view('front.products.show' , compact('product'));
    }
}
