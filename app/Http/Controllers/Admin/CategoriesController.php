<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin/categories/index')->with('categories', $categories);
    }

    public function create()
    {
        $categories = Category::where('parent_id', 0)->get();
        return view('admin/categories/create')->with('categories', $categories);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->category;
        $category->parent_id = $request->parent_id;
        $category->save();

        session()->flash('success', 'دسته بندی شما با موفقیت ایجاد گردید');
        return redirect(route('category.index'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', 0)->get();
        return view('admin/categories/create')->with(['category' => $category, 'categories' => $categories]);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->category;
        $category->parent_id = $request->parent_id;

        $category->update();

        session()->flash('success', 'دسته بندی شما با موفقیت ویرایش گردید');
        return redirect(route('category.index'));
    }


    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->parent_id == 0) {
            $category->parents()->delete();
            $category->delete();
        } else {
            $category->delete();
        }
        session()->flash('success', 'دسته بندی با موفقیت حذف گردید');
        return back();



        // if ($category->parents()->count()) {
        //     session()->flash('error', "برای حذف این دسته بندی باید ابتدا زیر منو هایش را حذف کنید");
        //     return back();
        // } else {
        //     $category->delete();
        //     session()->flash('success', 'دسته بندی با موفقیت حذف گردید');
        //     return back();
        // }
    }
}
