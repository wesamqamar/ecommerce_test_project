<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\Review;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('products.index' , compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create' , compact(
            'categories'
        ));
    }

    public function store(ProductRequest $request)
    {
        $product = new Product;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = 'storage/' . $imagePath;
        }

        $product->fill($request->validated());
        $product->save();

        session()->flash('success', 'Product Created Successfully');
        return redirect()->route('dashboard.products.index');
    }


    public function show(Product $product)
    {
        return view('products.show' , compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit' , compact('product','categories'));
    }

    public function update(ProductRequest $request, Product $product)
    {
        if ($request->hasFile('image')) {
            if ($product->image != 'images/product.png' && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $imagePath = $request->file('image')->store('images', 'public');
            $product->image = 'storage/' . $imagePath;
        }

        $product->fill($request->validated());
        $product->status_updated_at = now();
        $product->save();

        session()->flash('success', 'Product Updated Successfully');
        return redirect()->route('dashboard.products.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        session()->flash('success', 'Product Deleted Successfully');
        return redirect()->route('dashboard.products.index');
    }


    public function updateStatus(Request $request, Product $product)
    {
        $product->status = !$product->status;
        $product->status_updated_at = now();
        $product->save();

        return redirect()->back()->with('success', 'Product status updated successfully.');
    }
}

