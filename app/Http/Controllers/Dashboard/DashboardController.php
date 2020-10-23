<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\TransactionDetail;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $transactions = TransactionDetail::with(['transaction.user','product.gallery'])->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        });

        $revenue = $transactions->get()->reduce(function($carry, $item){
            return $carry + $item->price;
        });

        $customer = User::count();
        
        return view('pages.dashboard.dashboard', [
            'transaction_count' => $transactions->count(),
            'transaction_data' => $transactions->get(),
            'revenue' => $revenue,
            'customer' => $customer,
        ]);
    }
}
