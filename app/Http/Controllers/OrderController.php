<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderDetail;
use App\Models\Order;
use App\Models\Product;

class OrderController extends Controller
{
    public function show() {
        $user = Auth::user();
        $orders = $user->orders()->with([
            'orderDetails:order_id,product_id,quantity' => [
                'product:id,product_url,type_id,name,price' => [
                    'type:id,name'
                ],
            ],
        ])->orderBy('created_at', 'desc')->get();


        return Inertia::render('Order', [
            'orders' => $orders,
        ]);
    }

    public function create(Request $request) {
        $validated = $request->validate([
            'address' => 'required|string|min:3' ,
            'total' => 'required' ,
        ]);


        $items = [];
        foreach ($request->input('items') as $item) {
            $tempItem = [];
            $tempItem['product_id'] = $item['id'];
            $tempItem['quantity'] = $item['qty'];

            array_push($items, $tempItem);
        }
        
        $user = Auth::user();
        $order = $user->orders()->create([
            'address' => $validated['address'],
            'total' => $validated['total'],
        ]);

        $order->orderDetails()->createMany($items);


        return to_route('show-order')->with('message', 'ordered');
       
    }


    public function update(Order $order, Request $request) {
        // dd('ok');
        $order->status = 'S';
        
        // dd($order->orderDetails()->get());
        foreach($order->orderDetails()->get() as $orderDetails) {
            $product = Product::find($orderDetails->product_id);
            $product->stock = $product->stock - $orderDetails->quantity;
            $product->save();
        }
        $order->save();
        return to_route('dashboard');
    }

    public function delete(Request $request) {
        $validated = $request->validate([
            'activeId' => 'required'

        ]);
        $user = Auth::user();
        $orders = $user->orders();
        $orders->where('id', $validated['activeId'])->delete();
        return to_route('show-order');
    }
}
