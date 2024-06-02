<?php


namespace App\Helper;

class Helper{
    public static function menus($menus,$parent_id=0,$char=''){
        $html='';
        foreach($menus as $key =>$menu){
            if($menu->parent_id == $parent_id){
                $html .= '
                <tr style="height: 40px;">
                        <td>' . $menu->id .'</td>
                        <td>' .$char . $menu->name .'</td>
                        <td>' . self::active ($menu->active) .'</td>
                        <td>' . $menu->updated_at .'</td>
                        <td> 
                        <a class="btn btn-primary btn-sm" href="/admin/menu/edit/'. $menu->id.' "  >
                        <i class="ti-pencil-alt"></i>
                         </a>
                        <a class="btn btn-danger btn-sm" href="#" onclick="RemoveRow('. $menu->id.',\'/admin/menu/destroy\')">
                        <i class="ti-trash"></i>
                        </a> 
                        
                        </td>
                        </tr>
                ';
                unset($menus[$key]);

                $html .= self::menus($menus,$menu->id, $char .'--');
            }   
        }
        return $html;
    }
    public static function active($active =0):string{
        return $active ==0 ? '<span class="btn btn-danger">NO</span>' :'<span class="btn btn-success">YES</span>' ;
    }
}