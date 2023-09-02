<?php

namespace App\Http\Controllers;

use App\Events\DownloadPdfEvent;
use App\Jobs\NewOrderJob;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use PDF;
use App;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = 0;
        $carts = Cart::where('user_id', Auth::id())->get();

        foreach ($carts as $cart) {

            $total += $cart->product->price * $cart->quantity;
        }

        return view('order.index', [
            'carts' => $carts,
            'total' => $total
        ]);
    }

    public function myOrders()
    {
        $orders = Order::where('user_id', '=', \auth()->id())->orderBy('id', 'DESC')->get();

        return view('order.myOrders', [
            'orders' => $orders
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        NewOrderJob::dispatch($request->all());
        return redirect()->route('shopcart')->with('success', 'Place Ordered successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Order::find($id);
        $orderItems = OrderProduct::where('order_id', '=', $id)->get();

        return view('order.show', [
            'orderItems' => $orderItems,
            'order' => $data
        ]);
    }

    public function downloadPDF($order_id)
    {
        $order_items = OrderProduct::where('order_id', '=', $order_id)->get();

        foreach ($order_items as $item) {
            $data[] = [
                "id" => $item->product->id,
                "name" => $item->product->name,
                "description" => $item->product->description,
                "price" => $item->product->price,
                "quantity" => $item->quantity,
                "total" => intval($item->product->price) * intval($item->quantity),
            ];
        }

        event(new DownloadPdfEvent(compact('data'),$order_id));

        return redirect()->back()->with('success', 'Pdf Downloaded successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
