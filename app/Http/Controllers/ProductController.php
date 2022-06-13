<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;



class ProductController extends Controller
{
    public function index() {
        $title = 'List Products';

        $products = Product::with('category')->get;
        dd($products);

        return view('list-product', compact('title', 'products'));
    }
}
