<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductService;

class MenuControler extends Controller
{
    //
    protected $menuService;
    public function __construct(MenuService $menuService){
        
        $this->menuService = $menuService;
    
    }
    public function index(Request $request,$id,$slug){
        $menu = $this->menuService->getID($id);
        $product = $this->menuService->getProduct($menu);
        return view('menu',[
            'title' =>$menu->name,
            'products' =>$product,
            'menu'=> $menu,
        ]);
    }
}
