<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Order;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Illuminate\Support\Str;
class HomeController extends Controller
{
    
    public function my_home()
    {
        $data=Food::all();
        return view('home.index',compact("data"));
    }
    
    public function index()    
    {
        if (Auth::id())
        {
  
            $usertype =Auth()->user()->usertype;
            if($usertype =='user'){
                $data=Food::all();
                return view("home.index",compact('data'));
            }
            else
            {
                return view("admin.index");
            }
        }
    }
    
    public function add_cart(Request $request,$id)
    {
        if (Auth::id()){

            $food = Food::find($id);
            $cart_title=$food->title;
            $cart_details=$food->details;
            $cart_price = preg_replace('/[^0-9.]/', '', $food->price);
            $cart_image=$food->image;

            $data =new Cart;
            $data->title = $cart_title;
            $data->details = $cart_details;
            $data->price = $cart_price * $request->qty;
            $data->image = $cart_image;
            $data->quantity = $request->qty;
            $data->userid = auth()->user()->id;

            $data->save();
            return redirect()->back();



        }
        else{
            return redirect('login');
        }
    }

    public function my_cart(){
        $user_id = Auth()->user()->id;  
        $data = Cart::where('user_id','=',($user_id->get()));
        return view('home.my_cart',compact('data'));
    }
    public function home(){
        return view('home.index');
    }
    public function remove_cart($id){
        $data = Cart::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function confirm_order(Request $request){
        $user_id = Auth()->user()->id;
        $cart = Cart::where('user_id','=',($user_id->get()));
        foreach($cart as $data){
            $order = new Order;
            $order->name = $request->name;
            $order->email = $request->email;
            $order->phone = $request->phone;
            $order->address = $request->address;
            $order->title = $data->title;
            $order->quantity = $data->quantity;
            $order->price = $data->price;
            $order->image = $data->image;
            $order->save();
            $data=Cart::find($cart->id);
            $data->delete();
        }
        
        return redirect()->back();
    }
}
