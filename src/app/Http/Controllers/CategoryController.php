<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', ['categories' => $categories]);
    }

    public function show($id)
    {
        $category = Category::find($id);
        $products = $category->products()->get();
        return view('admin.categories.show', ['category' => $category, 'products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {

        $category = new Category();
        $category->title = $request->title;

        $imageName = time() . uniqid() . '.webp';
        $thumb = Image::make($request->file('photo'));
        $thumb_large = $thumb->widen(500)->encode('webp');
        Storage::disk('local')->put('public/images/categories/' . $imageName, $thumb_large);

        $category->image = $imageName;
        $category->save();

        return redirect()->back()->with('message', 'تم اضافة الفئة بنجاح');

    }

    public function delete(Request $request)
    {
        if (isset($_POST['delete'])) {

            $d = Category::where('id', $request->id)->first();
            $d->delete();

            return redirect()->back()->with('message', 'Category successfully deleted!');
        } else {
            echo "error";
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View|Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.categories.edit', ['category' => $category]);
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
        $category = Category::findOrFail($id);
        $imageName = $category->image;
        if ($request->file('photo') != null) {
            $thumb = Image::make($request->file('photo'));
            $thumb_large = $thumb->widen(500)->encode('webp');
            Storage::disk('local')->put('public/images/categories/' . $imageName, $thumb_large);
        }
        $category->update(["title" => $request->title, "image" => $imageName]);

        return redirect()->back()->with('message', 'تم تغيير تفاصيل الفئة بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse|Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('message', 'تم حذف الفئة بنجاح');
    }

}
