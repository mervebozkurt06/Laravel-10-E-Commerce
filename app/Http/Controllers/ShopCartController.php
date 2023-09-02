<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\isEmpty;

class ShopCartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datalist = Cart::where('user_id', Auth::id())->get();
        return view('cart.index', [
            'datalist' => $datalist
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
    public function store(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $data = Cart::where('product_id', $id)->where('user_id', Auth::id())->first();
            if ($data) {
                $data->quantity = $data->quantity + intval($request->input('quantity'));
            } else {
                $data = new Cart();
                $data->product_id = $request->id;
                $data->quantity = $request->input('quantity');
                $data->user_id = Auth::id();
            }
            $data->save();
            DB::commit();

        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Product could not added to cart.')->withInput();
        }

        return redirect()->back()->with('success', 'Product added to cart successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        DB::beginTransaction();
        try {
            $data = Cart::find($id);
            if (intval($request->input('quantity'))) {
                $data->quantity = intval($request->input('quantity'));
            }
            $data->update();
            DB::commit();

        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Cart could not edited')->withInput();
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();
        try {
            $data = Cart::find($id);
            $data->delete();
            DB::commit();
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();
            return back()->withError('Cart could not deleted.')->withInput();
        }

        return redirect()->back()->with('success', 'Product deleted from cart successfully');
    }
}
