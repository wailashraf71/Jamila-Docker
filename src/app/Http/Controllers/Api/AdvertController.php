<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advert;
use App\Models\Product;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class AdvertController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return DataTableCollectionResource
     */
    public function show(Request $request, $id)
    {
        if ($id == 0){
            $data = Product::orderBy('updated_at', 'desc')->paginate(20);
            return new DataTableCollectionResource($data);
        }
        $advert = Advert::findOrFail($id);
        $length = $request->input('length') ?? 50;
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        if ($searchValue != null)
            $query = $advert->products()->where('title', $searchValue)->orWhere('description', $searchValue)->orderBy('title', $orderBy ?? 'desc');
        else
            $query = $advert->products()->orderBy('title', $orderBy ?? 'desc');

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function products(Request $request, $id)
    {
        $searchValue = $request->input('search') ?? '';
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');

        if ($id == 0) {
            return Product::orderBy('updated_at', 'desc')->paginate(20)->items();
        }
        $advert = Advert::withCount('products')->findOrFail($id);
        $products = $advert->products()
            ->where('title', 'like', '%' . $searchValue . '%')
            ->orWhere('description', 'like', '%' . $searchValue . '%')
            ->orderBy($sortBy ?? 'title', $orderBy ?? 'desc')
            ->paginate(1000);
        return $products->items();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
