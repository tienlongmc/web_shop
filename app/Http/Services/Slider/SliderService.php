<?php

namespace App\Http\Services\Slider;

use App\Models\Menu;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Message;
use App\Models\Slider;
use Illuminate\Support\Facades\Log;

class SliderService{
    public function insert($request){
        try{
            $request->except('_token');
            Slider::create($request->input());
            session()->flash('success','Thêm Thành công Slider');
        }catch(Exception $err){
            session()->flash('error','Thêm thất bại');
            Log::info($err->getMessage());
            return false;
        } 
        return true;
    }
    public function get(){
        return Slider::orderBy('id', 'desc')->paginate(15); 
        
    }

    public function delete($request){
        $slider = Slider::where('id',$request->input('id'))->first();
        if($slider){
            $slider->delete();
            return true;
        }
        return false;
    }
}