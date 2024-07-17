<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CartService;

class CartController extends Controller
{
    //
    protected $cartService;
    public function __construct(CartService $cartService){
        $this->cartService = $cartService;
    }
    public function index(Request $request){
        $result = $this->cartService->create($request);
        if($result==false){
            return redirect()->back();
        }
        return redirect('/cart');
       
    }
    public function show(){
        $products = $this->cartService->getProduct();
        return view('carts.list',[
            'title'=> 'Gio Hang',
            'products' => $products,
            'carts' => Session()->get('carts')
        ]);
    }
 
    public function update(Request $request){
        // dd($request->all())
        $this->cartService->update($request);

        return redirect('/cart');
    }
    public function remove($id){
        $this->cartService->remove($id);

        return redirect('/cart');
    }
    public function addCart(Request $request){
         $this->cartService->addCart($request);
         return redirect()->back();
    }
}
