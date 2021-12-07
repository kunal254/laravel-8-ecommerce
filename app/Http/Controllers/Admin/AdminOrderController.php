<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    private $status_array = [
        "N" => ['PENDING', 'blue'],
        "C" => ['CANCELED', 'red'],
        "D" => ['DELIVERED', 'limegreen'],
        'P' => ['PAID', 'limegreen']
    ];
    
    private $transaction_mode = [
        "COD" => "Cash on Delivery"
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.orders.orders', [
            'orders' => Order::all(),
            'status' => $this->status_array
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.orders.order-detail', [
            'order' => $order,
            'status' => $this->status_array,
            'mode' => $this->transaction_mode
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return back();
    }
}
