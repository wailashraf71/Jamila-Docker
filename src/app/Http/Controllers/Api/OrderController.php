<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        $user = Auth::user();
        return $user->orders;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function store(Request $request)
    {
        //New Order
        $order = new Order;
        $order->user_id = Auth::user()->id;
        $order->address = $request->address;
        $order->phone = $request->phone;
        $order->city = $request->city;
        $order->total_price = $request->total_price;
        $order->save();

        //Order's Products
        foreach ($request->products as $product) {
            $order->products()->attach($order->id, [
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
        }
        return response()->json([
        "success" => true,
        "message" => 'Order has been placed'
    ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
