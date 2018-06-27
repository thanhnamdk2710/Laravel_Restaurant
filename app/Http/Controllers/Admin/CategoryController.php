<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);
        Toastr::success('Add New Category Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('categories.index');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        Category::findOrFail($id)->update([
            'name' => $request->name,
            'slug' => str_slug($request->name)
        ]);
        Toastr::success('Updated Category Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('categories.index');
    }

    public function destroy($id)
    {
        Category::findOrFail($id)->delete();
        Toastr::success('Deleted Category Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
