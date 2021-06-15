<?php

namespace App\Http\Controllers;

use App\Mail\OrderMail;
use App\Models\Order;
use App\Models\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {
        $orders = auth()->user()->orders()->pluck('order_id');

        $orders = Order::whereIn('order_id', $orders)->latest()->paginate(5);

        return view('orders.index', compact('orders'));
    }

    public function create(Request $request)
    {
        $session = Session::where('id', $request->session()->getId())->first();
        if ($session and $session->cart) {
            $cart = $session->cart;

            $user_address =  $session->user ? $session->user->address : null;
            return view('order.create', compact(['cart', 'user_address']));
        }
        return redirect("/");
    }

    public function store(Request $request)
    {
        $session = Session::where('id', $request->session()->getId())->first();
        if ($session and $session->cart and $session->cart->liquors()->exists()) {
            $cart = $session->cart;
            $address_data = $request->validate([
                'first_name' => ['required', 'max:255'],
                'last_name' => ['required', 'max:255'],
                'email' => ['email', 'required', 'max:255'],
                'address_1' => ['required', 'max:255'],
                'address_2' => ['', 'max:255'],
                'phone_number' => ['', 'max:255'],
                'city' => ['required', 'max:255'],
                'zipcode' => ['required', 'max:255'],
                'country' => ['required', 'integer'],
                'terms' => ['required'],
            ]);
            unset( $address_data['terms']);
            $order_data = [
                'state' => config('enums.choices')['ORDER_STATE_CHOICE_NEW'],
                'total_price' => $cart->total_price(),
            ];
            $user = $session->user;
            if ($user) {
                $order = $user->orders()->create($order_data);
            } else {
                $order = Order::create($order_data);
            }
            $liquors = $cart->liquors()->pluck('quantity', 'liquor_id')->toArray();

            foreach ($liquors as $liquor_id => $quantity) {
                $order->liquors()->attach($liquor_id, ['quantity' => $quantity]);
            }

            $order->address()->create($address_data);
            $cart->liquors()->detach();

            Mail::to($address_data['email'])->send(new OrderMail($order));

            return view('order.finished', compact(['cart', 'order']));
        }


        return redirect("/");
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }
}
