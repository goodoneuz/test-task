<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = auth()->user()->orders;
        if(auth()->user()->getRole()->hasPermission('View all orders'))
        $orders = Order::all();

        return view('home', compact('orders'));
    }
}
