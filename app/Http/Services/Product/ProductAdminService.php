<?php

namespace App\Http\Services\Product;

use App\Models\Menu;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Message;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductAdminService{

    public function getMenu()
    {
        return Menu::where('active',1)->get();
    }
    protected function isValidPrice($request)
    {
        if( $request->input('price') != 0 && $request->input('pricce_sale')!=0
            && $request->input('price_sale') >= $request->input('price') ){
            session()->flash('error','Giá giảm phải nhỏ hơn giá gốc');
            return false;
        }
        if( $request->input('price_sale')!= 0 && (int)$request->input('price')==0){
            session()->flash('error','Vui lòng nhập giá gốc');
            return false;
        }
        return true;
    }

    public function insert($request){
        $isValidPrice = $this->isValidPrice($request);
       
        if($isValidPrice ===false)
            return false;

            try{
                $request->except('_token');
                Product::create($request->all());
                session()->flash('success','Thêm Thành công sản phẩm');
            }catch(\Exception $err){
                session()->flash('error','Thêm lỗi sản phẩm');
                Log::info($err->getMessage());
                return false;
            }
            return true;
        
    } 
}