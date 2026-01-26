<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpatiePermission;
use Illuminate\Support\Facades\Validator;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;

class PermissionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:permission-list', ['only' => ['index','ajaxSettingData']]);
        $this->middleware('permission:permission-create', ['only' => ['create','store']]);
        $this->middleware('permission:permission-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:permission-delete', ['only' => ['destroy']]);
        $this->middleware('permission:permission-show', ['only' => ['show']]);
        $this->middleware('permission:permission-ajax-data', ['only' => ['ajaxSettingData']]);
    }  
    public function index()
    {
        $pagetitle   = "Permissions";
        $breadcrumbs = ["Dashboard", "Permissions"];
        $urls        = ['/', 'permissions/permission-list'];
        return view('permissions.index', compact('pagetitle', 'breadcrumbs', 'urls'));
    }
    public function ajaxSettingData()
    {
        $permissions    = SpatiePermission::where('parent_id','!=',0);
        return DataTables::of($permissions)
            ->addColumn('actions', function ($permissions)
            {
                $actions = "<div class='btn-toolbar'>";
                $actions .= "</div>";
                return $actions;
            })
            ->addColumn('created_at', function ($permissions) {

                return Carbon::parse($permissions->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('updated_at', function ($permissions) {

                return Carbon::parse($permissions->updated_at)->format('d-m-Y H:i:s');
               
            })
          
            ->addColumn('actions', function($row){
            
                $btn = "<div class='btn-toolbar'>";
                $user = Auth::user();
                $isSuperAdmin = isSuperAdmin();
                if($user->can('permission-edit') ||  $isSuperAdmin)
                {
                $btn = $btn.'<a class="me-3 text-primary cursor-pointer"  href="' . url("/permissions/permission-edit", $row->id) . '" data-toggle="tooltip" title="Edit"  ><i class="mdi mdi-pencil font-size-20"></i></a>';
                }  
                if($user->can('permission-delete') ||  $isSuperAdmin)
                {
                $btn = $btn.'<a href="javascript:void(0);" onclick=delete_record('.$row->id.') class="me-3 text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-20"></i></a>
                                                 <input id="delete_url_'.$row->id.'"  type="hidden" value="' . url('/permissions/permission-delete') . '" >';
                }
                $btn.'</div>';
                 return $btn;
            })
            ->rawColumns(['actions'])
            ->make(TRUE);
    }
    public function create()
    {
        $permissions=SpatiePermission::where('parent_id',0)->get();
        $pagetitle   = "Permissions";
        $breadcrumbs = ["Dashboard", "Permissions" ,"Create Permissions"];
        $urls        = ["/",'/permissions/permission-list', 'permissions/permission-create'];
        return view('permissions.create', compact('permissions','pagetitle', 'breadcrumbs', 'urls'));
    }
    public function store(Request $request)
    {
        $validator = $this->create_validator($request->all());
        if ($validator->fails()){
            
            return redirect('permissions/permission-create')
                        ->withErrors($validator)
                        ->withInput();
        }
        if(isset($request->add_new_module_checkbox) && $request->add_new_module_checkbox == 'on'){
            
            if($request->new_module == $request->permission_name){
                return redirect('permissions/permission-create')
                ->with('alert-error', 'Module and permission name cannot be same');
            }
            $module=New SpatiePermission;
            $module->name=$request->new_module;
            $module->guard_name = 'web';
            $module->parent_id=0;
            $module->created_by=Auth::user()->id;
            $module->updated_by=Auth::user()->id;
            $module->save();
            $module_id=$module->id;
        }
        else{
            $module_id=$request->module;
        }

        $permission=new SpatiePermission;
        $permission->name=$request->permission_name;
        $permission->guard_name = 'web';
        $permission->parent_id= $module_id;
        $permission->created_by=Auth::user()->id;
        $permission->updated_by=Auth::user()->id;
        $permission->save();
        if($permission)
        {    
            return redirect('permissions/permission-list')->with('alert-success', 'Permission Created Successfully');
        }
    }
    public function edit($id)
    {
        $permissions=SpatiePermission::where('parent_id',0)->get();
        $permission=SpatiePermission::where('id',$id)->first();
        $pagetitle   = "Permissions";
        $breadcrumbs = ["Dashboard", "Permissions" ,"Edit Permissions"];
        $urls        = ["/",'/permissions/permission-list', 'permissions/permission-edit/'.$id];
        return view('permissions.edit', compact('permission','permissions','pagetitle', 'breadcrumbs', 'urls'));
    
    }
    public function update(Request $request)
    {

        $validator = $this->update_validator($request->all(), $request->id);
        if ($validator->fails()){
            return redirect('permissions/permission-edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $permission=SpatiePermission::where('id',$request->id)->first();
        $permission->name=$request->permission_name;
        $permission->guard_name = 'web';
        $permission->parent_id=$request->module;
        $permission->updated_by=Auth::user()->id;
        $permission->save();
        if($permission->save())
        {    
            return redirect('permissions/permission-list')->with('alert-success', 'Permission Updated Successfully');
        }

    }
    public function destroy(Request $request){
        $id = $request->id;
        $parent = SpatiePermission::find($id);
        if($parent){
            foreach ($parent->children as $child){
                $child->delete();
        }
        }
       return $parent->delete();
    }

    private function create_validator(array $data, $id = 0)
    {
        if(isset($data['add_new_module_checkbox']) &&  $data['add_new_module_checkbox'] == 'on'){
            $rulesList=[
                'new_module' =>'required|max:150|unique:permissions,name',
                'permission_name' => 'required|max:150|unique:permissions,name',
            ];
            $messages =[
                'new_module.required' => 'Module name is required',
                'new_module.unique' => 'The module name has already been taken',
                'new_module.max' => 'Maximum length of 150 characters for module name is exceeded',
                'permission_name.required' => 'Permission name is required',
                'permission_name.unique' => 'The permission name has already been taken',
                'permission_name.max' => 'Maximum length of 150 characters for permission name is exceeded',
            ];
        }else{
            $rulesList=[
                'module' =>'required|',
                'permission_name' => 'required|max:150|unique:permissions,name',
            ];
            $messages =[
                'module.required' => 'Module name is required',
                'permission_name.required' => 'Permission name is required',
                'permission_name.unique' => 'The permission name has already been taken',
                'max.unique' => 'Maximum length of 150 characters for permission name is exceeded',
            ];
        }
        return $validator = Validator::make($data, $rulesList , $messages);
    }

    protected function update_validator(array $data, $id = 0)
    {
        $rulesList=[
            'module' =>'required',
            'permission_name' => 'required|max:150|unique:permissions,name,'.$id,  
        ];
        $messages =[
            'module.required' => 'Module name is required',
            'permission_name.required' => 'Permission name is required',
            'permission_name.unique' => 'The permission name has already been taken',
            'max.unique' => 'Maximum length of 150 characters for permission name is exceeded',
        ];
        return $validator = Validator::make($data, $rulesList , $messages);
    }
}