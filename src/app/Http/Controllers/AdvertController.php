<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\AdvertProduct;
use App\Models\Product;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $adverts = Advert::all();
        return view('admin.adverts.index', ['adverts' => $adverts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.adverts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $advert = new Advert();
        $advert->title = $request->title;

        $imageName = time() . uniqid() . '.webp';
        $thumb = Image::make($request->file('photo'));
        $thumb_large = $thumb->widen(500)->encode('webp');
        Storage::disk('local')->put('public/images/adverts/' . $imageName, $thumb_large);

        $advert->image = $imageName;
        $advert->save();

        return redirect()->back()->with('message', 'تم اضافة الاعلان بنجاح');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function show($id)
    {
        $advert = Advert::find($id);
        $products = $advert->products()->get();
        $allProducts = Product::all();
        return view('admin.adverts.show', ['advert' => $advert, 'products' => $products, 'allproducts' => $allProducts]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function addProduct(Request $request, $id)
    {
        $advert = Advert::find($id);
        $advert->products()->attach($advert->id, [
            'product_id' => $request->productItem,
        ]);
        return redirect()->back()->with('message', 'تم اضافة منتج الى الاعلان بنجاح');
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function removeProduct(Request $request, $id)
    {
        $advert = Advert::find($id);
        $advert->products()->detach($request->productItem);
        return redirect()->back()->with('message', 'تم حذف المنتج من الاعلان بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $advert = Advert::find($id);
        return view('admin.adverts.edit', ['advert' => $advert]);
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
        $advert = Advert::findOrFail($id);
        $imageName = $advert->image;
        if ($request->file('photo') != null) {
            $thumb = Image::make($request->file('photo'));
            $thumb_large = $thumb->widen(500)->encode('webp');
            Storage::disk('local')->put('public/images/adverts/' . $imageName, $thumb_large);
        }
        $advert->update(["title" => $request->title, "image" => $imageName]);

        return redirect()->back()->with('message', 'تم تغيير تفاصيل الاعلان بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $advert = Advert::findOrFail($id);
        $advert->delete();
        return redirect()->back()->with('message', 'تم حذف الاعلان بنجاح');
    }
}
