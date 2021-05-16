<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $orders = auth()->user()->orders()->pluck('order_id');

        $orders = Order::whereIn('order_id', $orders)->latest()->paginate(5);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        return view('order.create');
    }

    public function store()
    {
//        $data = request()->validate([
//            'key' => 'value',
//        ]);

//        auth()->user()->orders()->create([
//            $data
//        ]);

        return redirect('/' . auth()->user()->id . '/order/');
    }

    public function show(Order $order)
    {
        return view('order.show', compact('order'));
    }
}
