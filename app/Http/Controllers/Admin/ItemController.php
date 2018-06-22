<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('admin.items.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.items.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/items')) {
                mkdir('uploads/items', 0777, true);
            }

            $image->move('uploads/items', $imageName);
        } else {
            $imageName = 'default.png';
        }

        $item = new Item();
        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('items.index')->with('successMsg', 'Add New Item Successfully!');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('admin.items.edit', compact(['categories', 'item']));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'mimes:jpeg,jpg,png,bmp'
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->name);
        $item = Item::findOrFail($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!file_exists('uploads/items')) {
                mkdir('uploads/items', 0777, true);
            }

            unlink('uploads/items/' . $item->image);
            $image->move('uploads/items', $imageName);
        } else {
            $imageName = $item->image;
        }

        $item->category_id = $request->category;
        $item->name = $request->name;
        $item->description = $request->description;
        $item->price = $request->price;
        $item->image = $imageName;
        $item->save();

        return redirect()->route('items.index')->with('successMsg', 'Updated Item Successfully!');
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);

        if (file_exists('uploads/items/' . $item->image)) {
            unlink('uploads/items/' . $item->image);
        }

        $item->delete();

        return redirect()->route('items.index')->with('successMsg', 'Deleted Item Successfully!');
    }
}
