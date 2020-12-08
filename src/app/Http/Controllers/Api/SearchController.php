<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function getSearch(Request $request)
    {
        $product = (new Product)->newQuery();

        // Name
        if ($request->has('q')) {
            $keyword = $request->get('q');
            if (!$request->has('color', 'size', 'brand', 'category')) {
                $product->where('title', 'LIKE', '%' . $keyword . '%')->get();

            } else {
                $product->whereHas('variants', function ($query) use ($keyword) {
                    $query->where('title', 'like', '%' . $keyword . '%')->orWhere('description', 'LIKE', '%' . $keyword . '%');
                });
            }
        }

        $filter = $this->filter($request, $product);

        $result = $filter->paginate(10);
        if ($result->isEmpty()) {
            return response()->json([
                "success" => false,
                "message" => 'Nothing Found'
            ]);
        }
        return response()->json(
            [
                'data' => $result->items(),
                'meta' => [
                    "last_page" => $result->lastPage(),
                    "current_page" => $result->currentPage(),
                ],
            ]
        );
    }

    public function filter(Request $request, $product)
    {
        // Color
        if ($request->has('color')) {
            $keyword = $request->get('color');
            $product->whereHas('variants.color', function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')->orWhere('hex', 'LIKE', '%' . $keyword . '%');
            })->get();
        }

        // Size
        if ($request->has('size')) {
            $keyword = $request->get('size');
            $product->whereHas('variants.sizes', function ($query) use ($keyword) {
                $query->where('size', 'like', '%' . $keyword . '%');
            })->get();
        }

        // Price
        // USD
        if ($request->has('price_usd_start')) {
            $keyword_start = $request->get('price_usd_start');
            $keyword_end = $request->get('price_usd_end') ?? 10000;
            $product->whereHas('variants.price', function ($query) use ($keyword_start, $keyword_end) {
                $query->whereBetween('usd', array($keyword_start, $keyword_end));
            })->get();
        }
        // IQD
        if ($request->has('price_iqd_start')) {
            $keyword_start = $request->get('price_iqd_start');
            $keyword_end = $request->get('price_iqd_end') ?? 10000;
            $product->whereHas('variants.price', function ($query) use ($keyword_start, $keyword_end) {
                $query->whereBetween('iqd', array($keyword_start, $keyword_end));
            })->get();
        }

        // Brand
        if ($request->has('brand')) {
            $keyword = $request->get('brand');
            $product->whereHas('brand', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->get();
        }

        // Category
        if ($request->has('category')) {
            $keyword = $request->get('category');
            $product->whereHas('category', function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            })->get();
        }

        // Continue for all of the filters.

        // Get the results and return them.
        return $product;
    }
}
