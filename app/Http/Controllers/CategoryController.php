<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $data = [
            'categories' => Category::all(),
            'products' => Product::with(['gallery'])->take(8)->get()
        ];
        return view('pages.app.category', $data);
    }
}
