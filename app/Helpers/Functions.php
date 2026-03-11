<?php

use App\Models\Menu;
use App\Models\Setting;
use App\Models\SpatiePermission;
use App\Models\User;

if (!function_exists("optionForEachSelected")) {
    function optionForEachSelected(  $loopData ,$key , $value , $selectedValue = '' )
    {
        $option_html = '';
        // $loopData = (array) $loopData;
        if($loopData){
            foreach ($loopData as $item){
                if(isset($item->$key)){
                    $val_key = $item->$key;
                }else{
                    $val_key = $item[$key];
                }

                if(isset($item->$value)){
                    $val_value = $item->$value;
                }else{
                    $val_value = $item[$value];
                }

                $selected = '';
                if(is_array($selectedValue)){
                    if(  in_array($val_key,$selectedValue )  ){
                        $selected = 'selected';
                    }
                }else if(!is_array( $selectedValue) &&  $selectedValue){
                    if( $selectedValue == $val_key ){
                        $selected = 'selected';
                    }
                }else{
                    $selected ='';
                }

                $option_html .= '<option value="'.$val_key.'" '.$selected.'>'.ucfirst($val_value) .'</option>';
            }
        }
        return $option_html;
    }
}


function getIconImage($fileType){
    $fileType = strtolower($fileType);

    if(str_contains($fileType,'pdf'))
        return 'https://cdn-icons-png.flaticon.com/512/337/337946.png';

    if(str_contains($fileType,'jpg') || str_contains($fileType,'png') || str_contains($fileType,'jpeg'))
        return 'https://cdn-icons-png.flaticon.com/512/136/136524.png';

    if(str_contains($fileType,'doc'))
        return 'https://cdn-icons-png.flaticon.com/512/337/337932.png';

    if(str_contains($fileType,'xls'))
        return 'https://cdn-icons-png.flaticon.com/512/337/337948.png';

    return 'https://cdn-icons-png.flaticon.com/512/109/109612.png';
}


function get_setting($key)
{
    $setting = Setting::where('key',$key)->first();
    if($setting)
    {
        return $setting->value;
    }
    return false;
}
function isSuperAdmin()
{
   // $user_id = Auth::user()->id;
    $roles = hasRole();
    $adminRole = env('SUPER_ADMIN', "Administrator");
    $userIsSuperAdmin = false;
    if((isset($roles) && !empty($roles)) && !empty($adminRole))
    {
        if(in_array($adminRole,$roles))
        {
            $userIsSuperAdmin = true;
        }
    }

    return $userIsSuperAdmin;
}
function hasRole()
{
    $user = Auth::user();
    $roles = $user->roles->pluck('name')->all();
    return $roles;
}

function getPermissionName($id){
    $permission = SpatiePermission::where('id',$id)->first();
    if($permission)
    {
        return $permission->name;
    }
    return null;
}

function create_menus()
{
    $menus = Menu::where('parent_id','0')->where('active', '1')->orderBy('order')->get();
    $menu_html = create_menus_items($menus, 1);
    return $menu_html;
}

$level_one_dropdown = '';

function create_menus_items($menus, $level = 1,$level_one_dropdown="")
{ 
    if ($level > 1) {
        $level_one_dropdown = str_replace("#","",$level_one_dropdown);
        $html = '
        <div class="collapse menu-dropdown" id="'.$level_one_dropdown.'" >
            <ul class="nav nav-sm flex-column">';
    } else {
        $html = '';
    }
    foreach ($menus as $menu)
    {
        $hasChildWithPermission=false;
        if(count($menu->children) > 0  )
        {
            $children_data=Menu::where('parent_id',$menu->id)->where('permission','!=' ,0)->get();
            foreach($children_data as $data)
            {
                if(Auth::user()->can(getPermissionName($data->permission)))
                {
                    $hasChildWithPermission=true;
                    break;
                }
            }
           
        }
        if (isset($menu->permission) || $hasChildWithPermission){
            $permission_name=getPermissionName($menu->permission);
            if(($permission_name && Auth::user()->can($permission_name)) || $hasChildWithPermission || isSuperAdmin())
            {

                if ($menu->active == 1)
                {
                    if (count($menu->children) > 0 &&
                        (($menu->children->count() >= $menu->children->where('active', '1')->count()) &&
                            $menu->children->where('active', '1')->count() > 0))
                    {
                        if (!empty($menu->display_name))
                        {
                            $route = $menu->display_name;
                            $route = "#".str_replace(" ","_",$route);
                            
                        }
                        else
                        {
                            $route = url('#');
                        }
                        $html .='
                            <li class="nav-item">
                                <a class="nav-link menu-link" href="'.$route.'"  role="button"
                                    aria-expanded="false" aria-controls="sidebarTicketsTerminal" data-bs-toggle="collapse">
                                    <i class="mdi mdi-' . ($menu->icon == '' || $menu->icon == null ? 'link' : $menu->icon)  . '"></i><span>' . $menu->display_name .'</span>
                                </a>
                            ';
                        $child_level = $level + 1;
                        $level_one_dropdown = $route;
                        $html .= create_menus_items($menu->children()->orderBy('order')->get(), $child_level,$route);
                        $html .= "</li>";
                        
                    }
                    else 
                    {
                        if (Route::has($menu->route_name))
                        {
                            $route = route($menu->route_name);
                        }
                        else
                        {
                            $route = url('#');
                        }
                        $html .='
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="'. $route .'"  role="button"
                                aria-expanded="false" aria-controls="sidebarTicketsTerminal">
                                <i class="mdi mdi-' . ($menu->icon == '' || $menu->icon == null ? 'link' : $menu->icon)  . '"></i><span>' . $menu->display_name . '</span>
                            </a>
                        </li>';    
                    }
                }
            }
        }
    }

    if ($level > 1) {
        $html .= '</ul></div>';
    }
    return $html;
}

$html = '';

function create_menus_list($menus, $level = 1)
{
    if ($level > 1)
    {
        $html = '<ol class="dd-list">';
    }
    else
    {
        $html = '<div class="dd"><ol class="dd-list">';
    }
    foreach ($menus as $menu)
    {
        if ($menu->active == 1)
        {
            if (count($menu->children) > 0 &&
                (($menu->children->count() >= $menu->children->where('active', '1')->count()) &&
                    $menu->children->where('active', '1')->count() > 0))
            {
                $html .= '<li class="dd-item dd3-item" data-id="' . $menu->id . '"><div class="dd-handle dd3-handle">' .
                    $menu->display_name . '</div><div class="dd3-content"><a href="' . route('menus.edit', $menu->id) .
                    '"><i class="mdi mdi-pencil-box-outline"></i></a></div>';
                $child_level = $level + 1;
                $html .= create_menus_list($menu->children()->orderBy('order')->get(), $child_level);
                $html .= "</li>";
            }
            else
            {
                $html .= '<li class="dd-item dd3-item" data-id="' . $menu->id . '"><div class="dd-handle dd3-handle">' .
                    $menu->display_name . '</div><div class="dd3-content"><a href="' . route('menus.edit', $menu->id) .
                    '"><i class="mdi mdi-pencil-box-outline"></i></a></div></li>';
            }
        }
    }
    if ($level > 1)
    {
        $html .= '</ol>';
    }
    else
    {
        $html .= '</ol></div>';
    }
    return $html;
}

$order = 0;

function create_menus_array($menus, $menu_array = [], $parent_id = 0)
{
    global $order;
    foreach ($menus as $menu)
    {
        $order++;
        $menu_array[] = [
            "id" => $menu->id,
            "parent_id" => $parent_id,
            "order" => $order
        ];
        if (isset($menu->children) && count($menu->children) > 0)
        {
            $menu_array = create_menus_array($menu->children, $menu_array, $menu->id, $order);
        }
    }
    return $menu_array;
}

function icons()
{
  $icons_data=array();
  return json_encode($icons_data);
}

function getParentId($id)
{
    $user=User::where('id',$id)->first();
    if($user)
    {
        return $user->parent_id;
    }
    else
    {
        return 0;
    }
}
 
function imageUpload($image,$destination_path)
{
    $filename         = time().'.'. $image->getClientOriginalExtension();
    $image->storeAs($destination_path,$filename);
    return $filename;
}

