<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Product;
use App\Category;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Admin\ProductRequest;


class ProductController extends Controller
{
    public function index()
    {   
        return view('pages.dashboard.product', [
            'products' => Product::with(['gallery','category'])->where('users_id', Auth::user()->id)->get(),
        ]);
    }

    public function create()
    {
        return view('pages.dashboard.product-create', [
            'categories' => Category::all(),
        ]);
    }

    public function store(ProductRequest $request)
    {
        $getVar = $request->all();
        $getVar['slug'] = Str::slug($request->name);

        $product = Product::create($getVar);

        $gallery = [
            'products_id' => $product->id,
            'image' => $request->file('image')->store('uploads/images/gallery', 'public'),
        ];

        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    }

    public function details(Request $request, $id)
    {
        return view('pages.dashboard.product-detail', [
            'product' => Product::with(['gallery','user','category'])->findOrFail($id),
            'categories' => Category::all(),
        ]);
    }

    public function update(ProductRequest $request, $id)
    {
        $getVar = $request->all();
        $getVar['slug'] = Str::slug($request->name);

        $item = Product::findOrFail($id);
        $item->update($getVar);

        return redirect()->route('dashboard-product-detail', $id);
    }

    public function uploadProductGallery(Request $request)
    {
        $getVar = $request->all();
        $getVar['image'] = $request->file('image')->store('uploads/images/gallery', 'public');
        ProductGallery::create($getVar);

        return redirect()->route('dashboard-product-detail', $request->products_id);
    }

    public function deleteProductGallery($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('dashboard-product-detail', $item->products_id);
    }

    
}