<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Category[]|Collection|Response
     */
    public function index()
    {
        return Category::all();
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
     * @param Request $request
     * @param int $id
     * @return DataTableCollectionResource|Response
     */
    public function show(Request $request, $id)
    {
        if ($id == 0) {
            $data = Product::orderBy('updated_at', 'desc')->paginate(20);
            return new DataTableCollectionResource($data);
        }
        $category = Category::findOrFail($id);
        $length = $request->input('length') ?? 10;
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');
        $searchValue = $request->input('search');
        if ($searchValue != null)
            $query = $category->products()->where('title', $searchValue)->orWhere('description', $searchValue)->orderBy('title', $orderBy ?? 'desc');
        else
            $query = $category->products()->orderBy('title', $orderBy ?? 'desc');

        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function products(Request $request, $id)
    {
        $searchValue = $request->input('search') ?? '';
        $sortBy = $request->input('column');
        $orderBy = $request->input('dir');

        if ($id == 0) {
            return Product::orderBy('updated_at', 'desc')->paginate(20)->items();
        }
        $category = Category::withCount('products')->findOrFail($id);
        $products = $category->products()
            ->where('title', 'like', '%' . $searchValue . '%')
            ->orWhere('description', 'like', '%' . $searchValue . '%')
            ->orderBy($sortBy ?? 'title', $orderBy ?? 'desc')
            ->paginate(10);
        return $products->items();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
