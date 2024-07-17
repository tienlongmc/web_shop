<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\Slider\SliderService;
use App\Models\Slider;

class SliderController extends Controller
{
    protected $slider;
    public function __construct(SliderService $slider)
    {
        $this->slider = $slider;
    }
    public function create(){
        return view('admin.slider.add',[
            'title'=>'Thêm Slider mới'
        ]);
    }
    public function store(Request $request){
        $this->validate($request,[
            'name' =>'required',
             'file'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
             'url' => 'required',
        ]);
        $this->slider->insert($request);

        return redirect()->back();
    }
    public function index(){
        $sliders = Slider::orderBy('id', 'desc')->paginate(10);
        return view('admin.slider.list',[
            'title'=> 'Danh sách sản phẩm',
            // 'slider'=> $this->slider->get(),
            'sliders' => $sliders
        ]);
    }

    public function show(Slider $slider){
        return view('admin.slider.edit',[
            'title' => 'Chỉnh sửa slider',
            'slider' => $slider,
        ]);
    }
    public function destroy(Request $request){
        $result =  $this->slider->delete($request);
        if($result ==true){
            // Nếu xóa thành công, trả về một JSON response với thông điệp "Xóa thành công" và không có lỗi
        return response()->json([
            'error' => false,
            'message' => "Xóa thành công",
        ]);
        // Nếu không xóa thành công, trả về một JSON response với cờ lỗi đặt thành true
        return response()->json([
            'error' => true,
        ]);
    }
    }
    public function update(Request $request, Slider $slider)
    {
        $this->validate($request, [
            'name' => 'required',
            'thumb' => 'required',
            'url'   => 'required'
        ]);

        $result = $this->slider->update($request, $slider);
        if ($result) {
            return redirect('/admin/slider/list');
        }

        return redirect()->back();
    }
}
