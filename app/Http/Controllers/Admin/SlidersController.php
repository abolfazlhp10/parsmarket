<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Models\Slider;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SlidersController extends Controller
{
    public function index()
    {
        $sliders = Slider::all();
        return view('admin/sliders/index')->with('sliders', $sliders);
    }

    public function create()
    {
        return view('admin/sliders/create');
    }

    public function store(CreateSliderRequest $request)
    {

        $slider = new Slider();
        $slider->image = $request->image->store('sliders');
        $slider->save();

        session()->flash('success', 'عکس شما با موفقیت به اسلایدر اضافه گردید');
        return redirect(route('sliders.index'));
    }

    public function edit($id)
    {
        $slider=Slider::findOrFail($id);
        return view('admin/sliders/create')->with('slider',$slider);
    }

    public function update(UpdateSliderRequest $request, $id)
    {
        $slider=Slider::findOrFail($id);
        Storage::delete($slider->image);
        $slider->image=$request->image->store('sliders');
        $slider->save();

        session()->flash('success', 'عکس شما با موفقیت ویرایش گردید');
        return redirect(route('sliders.index'));
    }

    public function destroy($id)
    {
        $slider=Slider::findOrFail($id);
        Storage::delete($slider->image);
        $slider->delete();


        session()->flash('success', 'عکس شما با موفقیت حذف گردید');
        return redirect(route('sliders.index'));
    }
}
