<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function addOrder(Request $req)
    {
        $order = Order::create([
            'name' => $req->name,
            'price' => $req->price,
            'quantity' => $req->quantity,
            'email' => $req->email,
        ]);

        return response()->json([
            "status"=>200,
            "message"=>"Added To Cart Successfully"
        ]);
    }

    public function getOrders($email)
    {
        $orders = Order::where("email",$email)->get();

        return response()->json([
            "status"=>200,
            "data"=>$orders
        ]);
    }
}