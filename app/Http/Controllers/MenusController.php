<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\SpatiePermission as Permission;
use Auth;
use DB;
use Exception;
use Illuminate\Http\Request;
use Route;
use Validator;
use Yajra\DataTables\DataTables;
use Arr;
use App\Models\Icon;

class MenusController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('permission:menus-ajax', ['only' => ['index','ajaxMenusData']]);
        // $this->middleware('permission:menus-create', ['only' => ['create','store']]);
        //  $this->middleware('permission:menus-edit', ['only' => ['edit','update']]);
        //  $this->middleware('permission:menus-delete', ['only' => ['destroy']]);
        //  $this->middleware('permission:menus-show', ['only' => ['show']]);
    }   
 
    protected function validator(array $data, $id = 0)
    {
        $messages = [
            'title.required' => 'Title is required',
            'title.max' => 'Maximum length of 255 characters for title is exceeded',
            'title.unique' => 'This title already exist',
            'icon.required' => 'Icon is required',
            'display_name.required' => 'Display name is required',
            'display_name.max' => 'Maximum length of 255 characters for title is exceeded',
            'display_name.unique' => 'This Display name already exist',
            'route_name.required' => 'Route name is required',
            'permission.required' => 'Permission is required',
            'active.required' => 'Active is required',
        ];
        $v = Validator::make($data, [
            'title'   => 'required|max:255|unique:menus',
            'display_name'         => 'required|max:255',
            'display_name'   => 'required|max:255|unique:menus',
            'route_name'           => 'required',
            'icon'                  => 'required',
            'permission'           => 'required',
            'active'               => 'required'
        ] ,  $messages);

        return $v;
    }

    protected function update_validator(array $data, $id = 0)
    {
        $messages = [
            'title.required' => 'Title is required',
            'title.max' => 'Maximum length of 255 characters for title is exceeded',
            'title.unique' => 'This title already exist',
            'icon.required' => 'Icon is required',
            'display_name.required' => 'Display name is required',
            'display_name.max' => 'Maximum length of 255 characters for title is exceeded',
            'display_name.unique' => 'This Display name already exist',
            'route_name.required' => 'Route name is required',
            'permission.required' => 'Permission is required',
            'active.required' => 'Active is required',
        ];
        $v = Validator::make($data, [
            'title'   => 'required|max:255|unique:menus'.($id ? ",title,$id" : ''),
            'display_name'   => 'required|max:255|unique:menus'.($id ? ",display_name,$id" : ''),
            'route_name'           => 'required',
            'icon'                  => 'required',
            'permission'           => 'required',
            'active'               => 'required'
        ] ,  $messages);

        return $v;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $pagetitle   = "Menus";
        $breadcrumbs = ["Dashboard", "Menus"];
        $urls        = ['/', '/menus'];
        return view('menus.index', compact('pagetitle','breadcrumbs','urls'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pagetitle   = "Menus";
        $breadcrumbs = ["Dashboard", "Menus" ,"Create Menus"];
        $urls        = ["/",'/menus', 'menus/create'];
        $icons = Icon::where('active', 'Yes')->orderBy('name', 'ASC')->get();
        
        $all_routes = Arr::sort(Route::getRoutes());
        $all_menus = Menu::where('active', '1')->orderBy('title')->get();
        $menus =  Menu::where('parent_id', '0')->where('active', '1')->orderBy('order')->get();
        $permissions = Permission::orderBy('name')->get();
        return view('menus.create', compact('menus','pagetitle', 'breadcrumbs','urls', 'permissions', 'icons', 'all_menus', 'all_routes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try
        {
            $menu = $request->all();
            if(empty($menu['parent_id']))
            {
                $menu['parent_id'] = 0;
            }
            if(empty($menu['route_name']))
            {
                $menu['route_name'] = '#';
            }
            Menu::create($menu);
            DB::commit();
            //flash(__('messages.MENU_CREATION_SUCCESS'), "success", "success");

            return back()->with('alert-success', 'Menu added Successfully');
        }
        catch (Exception $e)
        {
            DB::rollback();
            //flash(__('messages.MENU_CREATION_FAILED'), "danger", "error");

            return back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Menu  $menu_item
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //dd($menu);
        $pagetitle   = "Manage Menus";
        $breadcrumbs = ["Dashboard", "Menus" ,"Manage Menus"];
        $urls        = ["/",'/menus', 'menus/'.$menu->id.'/edit'];
        //$urls        = ["/",'/menus', 'menus/'.$id.'/edit'];
        //$icons = str_replace("-", " ", []);
        $icons = Icon::where('active', 'Yes')->orderBy('name', 'ASC')->get();
        $all_routes = Arr::sort(Route::getRoutes());
        $all_menus = Menu::where('active', '1')->orderBy('title')->get();
        $menus =  Menu::where('parent_id', '0')->where('active', '1')->orderBy('order')->get();
        $permissions = Permission::orderBy('name')->get();
        return view('menus.edit', compact(['menus', 'menu', 'pagetitle', 'breadcrumbs','urls', 'permissions', 'icons', 'all_menus', 'all_routes']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $validator = $this->update_validator($request->all(), $menu->id);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        try
        {
            $menu->title = $request->input('title');
            $menu->display_name = $request->input('display_name');
            $menu->icon = $request->input('icon');
            $menu->description = $request->input('description');
            $menu->route_name = $request->input('route_name');
            $menu->permission = $request->input('permission');
            if(empty($request->input('parent_id')))
            {
                $menu->parent_id = 0;
            }
            else
            {
                $menu->parent_id = $request->input('parent_id');
            }
            if(empty($request->input('route_name')))
            {
                $menu->route_name = '#';
            }
            else
            {
                $menu->route_name = $request->input('route_name');
            }
            $menu->active = $request->input('active');
            if($request->input('active') == 0){
                $menu->order = 0;
            }
            $menu->update();

            $child_menus =  Menu::where('parent_id', $menu->id)->with('children')->get();
            $child_menus_array =  create_menus_array($child_menus);
            if(count($child_menus_array) > 0 && $menu->active == 0) {
                foreach ($child_menus_array as $cm) {
                    $chile_menu_item = Menu::find($cm["id"]);
                    $chile_menu_item->active = 0;
                    $chile_menu_item->parent_id = 0;
                    $chile_menu_item->order = 0;
                    $chile_menu_item->update();
                }
            }

            DB::commit();
           // flash(__('messages.MENU_UPDATE_SUCCESS'), "success", "success");

            return back()->with('alert-success', 'Menu updated Successfully');;
        }
        catch (Exception $e)
        {
            DB::rollback();
           // flash(__('messages.MENU_UPDATE_FAILED'), "danger", "error");

            return back();
        }
    }

    /**
     * Update Menu Order.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateMenuOrder(Request $request)
    {
        DB::beginTransaction();
        try
        {
            $menus = json_decode($request->input('menus'));
            $menus_array =  create_menus_array($menus);
            foreach ($menus_array as $menu)
            {
                $menu_item = Menu::find($menu["id"]);
                $menu_item->parent_id = $menu["parent_id"];
                $menu_item->order = $menu["order"];
                $menu_item->update();

            }
            DB::commit();
            // flash(__('messages.MENU_REORDER_SUCCESS'), "success", "success");

            return back();
        }
        catch (Exception $e)
        {
            DB::rollback();
            // flash(__('messages.MENU_REORDER_FAILED'), "danger", "error");

            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyMenu(Request $request)
    {
        $id = $request->id;
        DB::beginTransaction();
        try
        {
            $child_menus =  Menu::where('parent_id', $id)->with('children')->get();
            if(count($child_menus) > 0){
                DB::rollback();
              //  flash(__('messages.MENU_DELETED_EXCEPTION'), "danger", "error");
            } else {
                $user = Menu::find($id);
                $user->delete();
                DB::commit();
                //flash(__('messages.MENU_DELETED_SUCCESS'), "success", "success");
            }
            return $id;
        }
        catch (Exception $e)
        {
            DB::rollback();
            //flash(__('messages.MENU_DELETED_FAILED'), "danger", "error");

            return $id;
        }
    }

    public function ajaxMenusData()
    {
        # Check of Authenticated User Permissions
        $userPermissions = array(
            //'edit_menu' => Auth::user()->can('edit_menu'),
            //'delete_menu' => Auth::user()->can('delete_menu')
            'edit_menu'=>true,
            'delete_menu'=>true,
        );

        if(true)
        {
            $menus = Menu::where('id','<>',0);
        }
        else
        {
            $menus = Menu::where('super_admin','0');
        }

        return DataTables::of($menus)
            ->editColumn('active', function ($menu)
            {
                if($menu->active == 0)
                {
                    $actions = "No";
                }
                else
                {
                    $actions = "Yes";
                }

                return $actions;
            })
            ->addColumn('actions', function ($menu) use ($userPermissions)
            { 
                $actions = '<div class="btn-toolbar">';
                $user = Auth::user();
                $isSuperAdmin = isSuperAdmin();
                if($user->can('menus-edit') ||  $isSuperAdmin)
                {
                $actions .= '<a class="me-3 text-primary cursor-pointer" href="' . route("menus.edit", $menu->id) . '" data-toggle="tooltip" title="Edit Menu"><i class="mdi mdi-pencil fs-5"></i></a>';
                }
                if($user->can('menus-delet') ||  $isSuperAdmin)
                {
                    $actions .= '<a href="javascript:void(0);" onclick=delete_record('.$menu->id.') class="me-3 text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-20"></i></a>
                                                 <input id="delete_url_'.$menu->id.'"  type="hidden" value="' . url('/destroy-menus') . '" >';
                }
                $actions .= "</div>";
                return $actions;
            })
            ->rawColumns(['actions'])
            ->make(TRUE);
    }
}
