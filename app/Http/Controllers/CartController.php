<?php

namespace App\Http\Controllers;

use App\Cart;
use App\User;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'carts' => Cart::with(['user', 'product.gallery'])->where('users_id', Auth::user()->id)->get()
        ];
        
        return view('pages.app.cart', $data);
    }

    public function addToCart(Request $request, $id)
    {
        $getVar = [
            'products_id' => $id,
            'users_id' => Auth::user()->id
        ];
        Cart::create($getVar);

        return redirect()->route('cart');
    }

    public function delete(Request $request, $id)
    {
        $item = Cart::findOrFail($id);
        $item ->Delete();

        return redirect()->route('cart');
    }
}
