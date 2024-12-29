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
use Illuminate\Support\Facades\View;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth::user()->usertype;
            $foods = Food::all();
            View::share('foods', $foods);
            
            if($usertype == 'user')
            {
                return view('home.index', compact('foods'));
            }
            else
            {
                $total_user = User::where('usertype','=','user')->count();
                $total_food = Food::count();
                $total_order = Order::count();
                $total_delivered = Order::where('delivery_status', '=', 'Delivered')->count();

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
            $quantity = $request->qty;

            // Get food details
            $food = Food::find($food_id);
            
            $cart = new Cart;
            $cart->user_id = $user_id;
            $cart->food_id = $food_id;
            $cart->quantity = $quantity;
            $cart->price = $food->price;
            $cart->title = $food->title;

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
        $cart_items = Cart::where('user_id', '=', $user_id)
            ->join('food', 'carts.food_id', '=', 'food.id')
            ->select('carts.*', 'food.title', 'food.price', 'food.image')
            ->get();

        $total_price = 0;
        foreach($cart_items as $item) {
            $total_price += $item->price * $item->quantity;
        }

        return view('home.my_cart', compact('cart_items', 'total_price'));
    }
    
    public function remove_cart($id)
    {
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function my_home()
    {
        $foods = Food::all();
        View::share('foods', $foods);  // Share foods with all views
        return view('home.index', compact('foods'));
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
        if(!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();
        $user_id = $user->id;
        
        $cart_items = Cart::where('user_id', '=', $user_id)
            ->join('food', 'carts.food_id', '=', 'food.id')
            ->select('carts.*', 'food.title', 'food.price', 'food.image')
            ->get();
        
        foreach($cart_items as $item)
        {
            $order = new Order;
            $order->name = $request->name ?? $user->name ?? 'Guest';  // Fallback to request name or 'Guest'
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->title = $item->title;
            $order->quantity = $item->quantity;
            $order->price = $item->price;
            $order->image = $item->image;
            $order->delivery_status = 'In Progress';
            $order->user_id = $user_id;  // Save user_id in orders
            $order->save();
            
            Cart::where('id', $item->id)->delete();
        }
        
        return redirect()->back()->with('message', 'Order placed successfully!');
    }
}
