<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Product\ProductService;

class ProductHomeController extends Controller
{
    //
    protected $productService;
    public function __construct(ProductService $productService){
        $this->productService = $productService;
    }
    public function index($id = '',$slug=''){
        $product = $this->productService->show($id);
        $productMore = $this->productService->more($id);
        return view('products.detail',[
            'title' =>$product->name,
            'product'=>$product,
            'products'=>$productMore
        ]);
    }
}
