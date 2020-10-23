<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use App\Cart;
use App\Transaction;
use App\TransactionDetail;

use Exception;

use Midtrans\Config;
use Midtrans\Snap;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Save user data
        $user = Auth::user();
        $user->update($request->except('total_price'));

        // Checkout process
        $code = 'BBKLN'.mt_rand(0000, 9999).'COUT';
        $carts = Cart::with(['product', 'user'])
                    ->where('users_id', Auth::user()->id)
                    ->get();

        // Input to transaction table
        $transaction = Transaction::create([
            'users_id' => Auth::user()->id,
            'insurance_price' => 0,
            'shiping_price' => 0,
            'total_price' => $request->total_price,
            'transaction_status' => 'pending',
            'code' => $code
        ]);

        // Input to transaction_detail table
        foreach ($carts as $cart) {
            $trx = 'BBKLN'.mt_rand(0000,9999).'TRX';

            TransactionDetail::create([
                'transactions_id' => $transaction->id,
                'products_id' => $cart->product->id,
                'price' => $cart->product->price,
                'shiping_status' => 'PENDING',
                'resi' => '',
                'code' => $trx
            ]);
        }

        // Delete cart
        Cart::where('users_id', Auth::user()->id)->delete();

        // Midtrans confiduration
        
        /*
        Config::$serverKey = config('services.midtrans.serverKey'); // Set your Merchant Server Key
        Config::$isProduction = config('services.midtrans.isProduction'); // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        Config::$isSanitized = true; // Set sanitization on (default)
        Config::$is3ds = true; // Set 3DS transaction for credit card to true

        // Initialize data to midtrans
        $midtrans = [
            'transaction_details' => [
                'order_id' => $code,
                'gross_amount' => (int) $request->total_price,
            ], 
            'customer_details' => [
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email,
            ],
            'enabled_payments' => [
                'gopay', 'permata_va', 'bank_transfer'
            ],
            'vtweb' => []
        ];
        */
    }

    public function callback(Request $request)
    {
        # code...
    }
}
