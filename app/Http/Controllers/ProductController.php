<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        $title = 'List Products';

        return view('list-product', compact('title'));
    }
}
