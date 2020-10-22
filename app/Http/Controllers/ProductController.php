<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    public function detail (Request $request, $slug)
    {
        $data = [
            'product' => Product::with(['gallery','user'])->where('slug', $slug)->firstOrFail()
        ];

        return view('pages.app.product', $data);
    }
}
