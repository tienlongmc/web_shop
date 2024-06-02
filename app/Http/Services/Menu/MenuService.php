<?php

namespace App\Http\Services\Menu;
use App\Models\Menu;
use Exception;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Str;
use GuzzleHttp\Psr7\Message;


class MenuService{

  
    public function create($request){
       try{
        Menu::create([
            'name' => (string )$request->input('name'),
            'parent_id' => (string )$request->input('parent_id'),
            'description' => (string )$request->input('description'),
            'content' => (string )$request->input('content'),
            'active' => (string )$request->input('active'),
            'slug' =>Str::slug($request->input('name'),'-')
            
        ]);
        session()->flash('success','Tạo thành công');
       }catch(\Exception $ex){
        session()->flash('error',$ex->getMessage());
        return false;
       }
       return true;
    }
    
    public function get_parent()
    { 
        return Menu::
        where('parent_id' ,0)
        ->get();
    }
    public function getAll(){
        // phaan trang
        return Menu::orderByDesc('id')->paginate(20);
    }
    public function update($request, $menu){
       // $menu->fill($request->input());
        
        if($request->input('parent_id')!= $menu->id){
            $menu->parent_id = (int) $request->input('parent_id');
        }
        $menu->name = (string) $request->input('name');
       
        $menu->description = (string) $request->input('description');
        $menu->content = (string) $request->input('content');
        $menu->active = (string) $request->input('active');
        $menu->save();
        Session()->flash('success','Cập nhập thành công');
        return true;


    }
    public function destroy($request){
        // Trích xuất 'id' từ input của yêu cầu và ép kiểu nó thành số nguyên
        $id = (int) $request->input('id');
        
        // Truy vấn mô hình Menu để tìm mục menu có ID đã cho
        $menu = Menu::where('id', $id)->first();
        
        // Nếu mục menu tồn tại
        if($menu){
            // Xóa cả mục menu và bất kỳ mục nào có mục menu hiện tại làm cha
            return Menu::where('id', $id)->orWhere('parent_id', $id)->delete();
        }
    
        // Nếu mục menu không tồn tại, trả về false
        return false;
    }

    

}