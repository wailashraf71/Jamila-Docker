<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $products = Product::all();
        return response(view('admin.products.index', ['products' => $products]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        return response(view('admin.products.create', ['categories' => $categories]));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function store(Request $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->sku = $request->sku;
        $product->description = $request->description;
        $product->quantity = $request->quantity;
        $product->price = $request->price;
        $product->box_items = $request->box_items;

        $imageName = time() . uniqid() . '.webp';
        $thumb = Image::make($request->file('photo'));
        $thumb_large = $thumb->widen(800)->encode('webp');
        Storage::disk('local')->put('public/images/products/' . $imageName, $thumb_large);

        $product->image = $imageName;
        $product->save();

        if ($request->category != null) {
            $category_product = new CategoryProduct();
            $category_product->product_id = $product->id;
            $category_product->category_id = $request->category;
            $category_product->save();
        }
        return redirect()->back()->with('message', 'تم اضافة المنتج بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
//        $product = Product::findOrFail($id);
//        return response(view('admin.products.show', ['product' => $product]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $category_product = CategoryProduct::where('product_id', $product->id)->pluck('category_id')->first();
        return response(view('admin.products.edit', ['product' => $product, 'categories' => $categories, 'category_product' => $category_product]));
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
        $product = Product::findOrFail($id);
        $imageName = $product->image;
        if ($request->file('photo') != null) {
            $thumb = Image::make($request->file('photo'));
            $thumb_large = $thumb->widen(800)->encode('webp');
            Storage::disk('local')->put('public/images/products/' . $imageName, $thumb_large);
        }
        if ($category_product = CategoryProduct::where('product_id', $product->id)->first())
            $category_product->update(["category_id" => $request->category]);
        else {
            $category_product = new CategoryProduct();
            $category_product->product_id = $product->id;
            $category_product->category_id = $request->category;
            $category_product->save();
        }
        $product->update(["title" => $request->title, "image" => $imageName, "sku" => $request->sku,
            "description" => $request->description, "price" => $request->price, "quantity" => $request->quantity,
            "box_items" => $request->box_items]);

        return redirect()->back()->with('message', 'تم تغيير تفاصيل المنتج بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect()->back()->with('message', 'تم حذف المنتج بنجاح');
    }
}
