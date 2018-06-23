<?php

namespace App\Http\Controllers\Admin;

use App\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;

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
            'image' => 'required|mimes:jpeg,jpg,png,bmp',
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
        Toastr::success('Add New Slider Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('sliders.index');
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
            'image' => 'mimes:jpeg,jpg,png,bmp',
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

            unlink('uploads/sliders/' . $slider->image);
            $image->move('uploads/sliders', $imageName);
        } else {
            $imageName = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imageName;
        $slider->save();
        Toastr::success('Updated Slider Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->route('sliders.index');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);

        if (file_exists('uploads/sliders/' . $slider->image)) {
            unlink('uploads/sliders/' . $slider->image);
        }

        $slider->delete();
        Toastr::success('Deleted Slider Successfully!', 'Success', ["positionClass" => "toast-top-right"]);

        return redirect()->back();
    }
}
