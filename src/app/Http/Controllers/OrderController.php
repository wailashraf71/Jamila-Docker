<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        $orders_count = Order::count();
        return response(view('admin.orders.index', [
            'orders' => $orders,
            'orders_count' => $orders_count,
        ]));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return DataTableCollectionResource
     */
    public function data(Request $request)
    {
        $length = $request->input('length');
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        if ($searchValue != null)
            $query = Order::with('user')->where('id', $searchValue)->orWhere('address', $searchValue)->orWhere('phone', $searchValue)->orderBy('created_at', $orderBy ?? 'desc');
        else
            $query = Order::with('user')->orderBy('created_at', $orderBy ?? 'desc');

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {
        $order = Order::with('user', 'products')->find($id);
        $orderTotalQuantity = $order->products()->get()->sum('pivot.quantity');
        $orderTotalPrice = $order->products()->get()->sum(function($orderProduct) {
            return $orderProduct->pivot->quantity * $orderProduct->price;
        });
        return view('admin.orders.show', [
            'order' => $order,
            'order_total_quantity' => $orderTotalQuantity,
            'order_total_price' => $orderTotalPrice]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->accepted = !$request->accepted;
        if (!$request->accepted) {
            if ($order->products()->get() != null) {
                foreach ($order->products()->get() as $orderProduct) {
                    $product = Product::find($orderProduct->id);
                    $product->quantity -= $orderProduct->pivot->quantity;
                    $product->save();
                }
            }
        } else {
            if ($order->products()->get() != null) {
                foreach ($order->products()->get() as $orderProduct) {
                    $product = Product::find($orderProduct->id);
                    $product->quantity += $orderProduct->pivot->quantity;
                    $product->save();
                }
            }
        }
        $order->save();

        $message = '';
        if (!$request->accepted) $message = 'تمت الموافقة على الطلب ' . $id . ' بنجاح';
        else $message = 'تم الغاء الطلب ' . $id . ' بنجاح';

        return redirect('admin/orders')->with('message', $message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|RedirectResponse|Response|Redirector
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();
        return redirect('admin/orders')->with('message', 'تم حذف الطلب ' . $id . ' بنجاح');
    }
}
