<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth::user()->usertype;
            
            if($usertype == '0')
            {
                return view('dashboard');
            }
            else
            {
                $total_user = User::where('usertype','=','user')->count();
                $total_food = Food::count();
                $total_order = Order::count();
                $total_delivered = Order::where('delivery_status','=','Delivered')->count();

                return view("admin.index",compact('total_user','total_food','total_order','total_delivered'));
            }
        }
        else {
            return redirect()->back();
        }
    }
    
    public function add_cart(Request $request,$id)
    {
        if(Auth::id())
        {
            $user_id = Auth::id();
            $food_id = $id;
            $quantity = $request->quantity;

            $cart = new Cart;

            $cart->user_id = $user_id;
            $cart->food_id = $food_id;
            $cart->quantity = $quantity;

            $cart->save();

            return redirect()->back();
        }
        else
        {
            return redirect('/login');
        }
    }

    public function my_cart()
    {
        $user_id = Auth::id();
        $data = Cart::where('user_id', '=', $user_id)->get();
        return view('home.my_cart',compact('data'));
    }
    
    public function remove_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function my_home()
    {
        $data = Food::all();
        return view('home.index', compact('data'));
    }

    public function book_table(Request $request)
    {
        $data = new Book;

        $data->phone = $request->phone;
        $data->guest = $request->n_guest;
        $data->date = $request->date;
        $data->time = $request->time;

        $data->save();

        return redirect()->back();
    }

    public function confirm_order(Request $request)
    {
        $user_id = Auth::id();
        $cart = Cart::where('user_id', '=', $user_id)->get();
        
        foreach($cart as $item)
        {
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->title = $item->title;
            $order->quantity = $item->quantity;
            $order->price = $item->price;
            $order->image = $item->image;
            $order->save();
            
            $item->delete();
        }
        
        return redirect()->back();
    }
}
