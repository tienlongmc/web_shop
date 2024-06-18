<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use App\Http\Services\Product\ProductAdminService;
use Carbon\Carbon;
use App\Models\Product;


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
        return view('admin.product.list',[
            'title'=> 'Danh sách sản phẩm',
            'product'=> $this->productService->get()
        ]);
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
    public function show(Product $product) //ten bien trung voi ten trong route
    {
        //
        return view('admin.product.edit',
        ['title'=>'Chỉnh Sửa Sản Phẩm',
        'product' => $product,
        'menus' => $this->productService ->getMenu()
    ]);
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
    public function update(Request $request, Product $product)
    {
       $a =  $this->productService->update($request,$product);
       if($a ==true){
        return redirect('/admin/product/list');
       }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $result =  $this->productService->delete($request);
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
}
