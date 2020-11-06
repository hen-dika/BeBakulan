<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'categories' => Category::all(),
            'products' => Product::paginate($request->input('limit', 3))
        ];

        return view('pages.app.category', $data);
    }

    public function detail(Request $request, $slug)
    {
            $categories = Category::all();
            $category = Category::where('slug', $slug)->firstOrFail();
            $products = Product::where('categories_id', $category->id)->paginate($request->input('limit', 12));

        return view('pages.app.category', [
            'categories' => $categories,
            'category' => $category,
            'products' => $products
        ]);
    }
}
