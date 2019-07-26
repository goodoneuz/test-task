<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
            'time' => 'required',
            'service_id' => 'required|numeric',
            'description'
        ]);
        $data = [
            'date' => $data['date'] . ' ' . $data['time'],
            'service_id' => $data['service_id'],
            'description' => $request->get('description', ''),
            'status' => Order::STATUS_CREATED,
            'user_id' => auth()->id()
        ];
        $order = Order::create($data);
        return back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        if ($order->user_id == auth()->id() || auth()->user()->getRole()->hasPermission('Delete all orders'))
            $order->delete();
        else
            return back()->with(['error' => "You can delete only your orders"]);

        return back();
    }
    public function changeStatus(Order $order, $type){
        if ($order->user_id == auth()->id() || auth()->user()->getRole()->hasPermission('Edit all orders'))
            $order->update(['status' => $type]);
        else
            return response()->json(['error' => "You can edit only your orders"]);

        return response()->json(['result' => $order->statusName()]);
    }
}
