<?php

namespace App\Http\Controllers\Admin;
use App\Models\Menu;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\CreateFormRequest;
use Illuminate\Http\Request;
use App\Http\Services\Menu\MenuService;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class MenuController extends Controller
{
    //
    protected $menuService;

    public function __construct(MenuService $menuService) // Fix: __construct instead of _construct
    {
        $this->menuService = $menuService;
    }

    public function create(){
        return view('admin.menu.add',[
            'title'=>'Thêm danh mục mới',
            'menus' => $this->menuService ->get_parent(0)
        ]);
    }
    public function store(CreateFormRequest $request){
        //dd($request->input());
        $this->menuService->create($request);
       return redirect()->back();
    }

    public function index()
{
    return view('admin.menu.list',[
        'title'=>'Danh sách danh mục mới nhất',
        'menus' => $this->menuService->getAll()
    ]);
}
public function destroy(Request $request): JsonResponse {
    // Gọi phương thức destroy của menuService để thực hiện xóa mục menu
    $result = $this->menuService->destroy($request);

    // Kiểm tra kết quả của hoạt động xóa
    if ($result == true) {
        // Nếu xóa thành công, trả về một JSON response với thông điệp "Xóa thành công" và không có lỗi
        return response()->json([
            'error' => false,
            'message' => "Xóa thành công",
        ]);
    }

    // Nếu không xóa thành công, trả về một JSON response với cờ lỗi đặt thành true
    return response()->json([
        'error' => true,
    ]);
}
public function show(Menu $menu){
   
    return view('admin.menu.edit',[
        'title'=>'Chỉnh sửa danh mục ' . $menu->name,
        'menu' => $menu ,
        'menus' => $this->menuService->get_parent(0) 
    ]);
}
public function update(Menu $menu,CreateFormRequest $request){
    $this->menuService->update($request,$menu);
    return redirect('/admin/menu/list');

}

}
