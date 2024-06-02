<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductAdminService;
use Carbon\Carbon;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $productService;
    public function __construct(ProductAdminService $productService) // Fix: __construct instead of _construct
    {
        $this->productService = $productService;
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('admin.product.add',[
            'title'=> "Thêm sản phẩm mới",
            'menus' => $this->productService ->getMenu()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
       
      $this->productService->insert($request);

      return redirect()->back();
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
