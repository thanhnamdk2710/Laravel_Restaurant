<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();

        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'required|mimes:jpeg,jpg,png,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('uploads/sliders')) {
                mkdir('uploads/sliders', '0777', true);
            }
            $image->move('uploads/sliders', $imageName);
        } else {
            $imageName = 'default.png';
        }

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();

        return redirect()->route('sliders.index')->with('successMsg', 'Add New Slider Successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);

        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'mimes:jpeg,jpg,png,bmp,png',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->title);
        $slider = Slider::findOrFail($id);

        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            if (!file_exists('uploads/sliders')) {
                mkdir('uploads/sliders', '0777', true);
            }
            $image->move('uploads/sliders', $imageName);
        } else {
            $imageName = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();

        return redirect()->route('sliders.index')->with('successMsg', 'Updated Slider Successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (file_exists('uploads/sliders/' . $slider->image)) {
            unlink('uploads/sliders/' . $slider->image);
        }

        $slider->delete();

        return redirect()->route('sliders.index')->with('successMsg', 'Deleted Slider Successfully!');
    }
}
