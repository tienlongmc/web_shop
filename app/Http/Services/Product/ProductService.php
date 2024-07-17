<?php

namespace App\Http\Services\Product;

use App\Models\Product;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Message;
use Illuminate\Support\Facades\Log;

class ProductService{
    const LIMIT = 4;
    public function get($page =null){
        return Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->orderByDesc('id')
        ->when($page != null, function ($query) use ($page) {
            $query->offset($page * self::LIMIT);
        })
        ->limit(self::LIMIT)
        ->get();

    }
    public function show($id){
        return Product::where('id',$id)
        ->with('menu')
        ->where('active',1)->firstOrFail();
    }
    public function more($id){
        $currentProduct = $this->show($id);
        $menuId = $currentProduct->menu_id;    
        return  Product::select('id', 'name', 'price', 'price_sale', 'thumb')
        ->orderByDesc('id')
        ->where('menu_id', $menuId)
        ->where('active',1)
        ->where('id','!=', $id)
        ->limit(self::LIMIT)
        ->get();
    }

}