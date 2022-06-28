<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductRequest;




class ProductController extends Controller
{
    public function __construct() {

    }

    public function index() {
        $title = 'List Products';

        $products = Product::with('category')->paginate(2);


        if (Auth::check()) {
            return view('list-product', compact('title', 'products'));
        } else {
            return redirect()->route('auth.login');
        }
    }


    public function getAddProduct() {
        $title = 'Add Products';
        $categories = Category::all();

        return view('components.products.add', compact('title', 'categories'));
    }

    public function addProduct(ProductRequest $request) {
        $product = Product::create([
            'product_name' => $request->product_name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        $product->save();
        return redirect()->route('products.index')->with('msg', 'Add product successfully!');
    }

    public function getUpdateProduct($id = null) {
        $product = Product::find($id);
        $categories = Category::all();


        $title = "Update Product";

        return view('components.products.update', compact('product', 'title', 'categories'));
    }

    public function updateProduct(ProductRequest $request, $id = null) {
        $product = Product::find($id)->update([
            'product_name' => $request->product_name,
            'amount' => $request->amount,
            'category_id' => $request->category_id,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return back()->with('msg', 'Update product successfully!');

    }

    public function deleteProduct($id) {
        $product = Product::find($id);

        $product->delete();

        return redirect()->route('products.index')->with('msg', 'Delete Product successfully!');

    }

    public function deleteAllProduct() {
        Product::truncate();

        return back()->with('msg', 'Delete all product successfully!');
    }
}
