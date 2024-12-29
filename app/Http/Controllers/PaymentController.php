<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function cashPayment(Request $request)
    {
        // Delete all pending orders for the user
        Order::where('user_id', auth()->id())
             ->where('delivery_status', 'pending')
             ->delete();

        return redirect('/my_cart')->with('message', 'Thank you! Your food is in processing.');
    }

    public function showCardPayment(Request $request)
    {
        $total_price = Order::where('user_id', auth()->id())
                           ->where('delivery_status', 'pending')
                           ->sum('price');

        // Delete all pending orders after getting total price
        Order::where('user_id', auth()->id())
             ->where('delivery_status', 'pending')
             ->delete();

        return view('home.card_payment', compact('total_price'));
    }

    public function processCardPayment(Request $request)
    {
        // No need to delete orders here as they were already deleted in showCardPayment
        return redirect('/my_cart')->with('message', 'Payment successful! Your food is in processing.');
    }
}
