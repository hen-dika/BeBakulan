<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\TransactionDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.gallery'])
                            ->whereHas('product', function($product){
                                $product->where('users_id', Auth::user()->id);
                            })->get();
        $buyTransactions = TransactionDetail::with(['transaction.user','product.gallery'])
                            ->whereHas('transaction', function($transaction){
                                $transaction->where('users_id', Auth::user()->id);
                            })->get();
        
        return view('pages.dashboard.transaction',[
            'sellTransactions' => $sellTransactions,
            'buyTransactions' => $buyTransactions
        ]);
    }

    public function detail($id)
    {
        return view('pages.dashboard.transaction-detail',[
            'transaction' => TransactionDetail::with(['transaction.user','product.gallery'])->findOrFail($id),
        ]);
    }

    public function update(Request $request, $id)
    {
        $getVar = $request->all();
        TransactionDetail::findOrFail($id)->update($getVar);

        return redirect()->route('dashboard-transaction-detail', $id);
    }
}
