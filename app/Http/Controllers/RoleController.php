<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpatieRole;
use Illuminate\Support\Facades\Validator;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Auth;
use App\Models\SpatiePermission;
use Illuminate\Support\Facades\Storage;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:role-list', ['only' => ['index','ajaxSettingData']]);
        $this->middleware('permission:role-create', ['only' => ['create','store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->middleware('permission:role-show', ['only' => ['show']]);
    }  
    public function index()
    {
        $pagetitle   = "Roles";
        $breadcrumbs = ["Dashboard", "Roles"];
        $urls        = ['/', 'roles/role-list'];
        return view('roles.index', compact('pagetitle', 'breadcrumbs', 'urls'));
    }
    public function ajaxSettingData()
    {
        $roles    = SpatieRole::where('id','<>',0);
        return DataTables::of($roles)
            ->addColumn('actions', function ($roles)
            {
                $actions = "<div class='btn-toolbar'>";
                $actions .= "</div>";
                return $actions;
            })
            ->addColumn('created_at', function ($roles) {

                return Carbon::parse($roles->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('updated_at', function ($roles) {

                return Carbon::parse($roles->updated_at)->format('d-m-Y H:i:s');
               
            })
          
            ->addColumn('actions', function($row){
            
                $btn = "<div class='btn-toolbar'>";    
                $user = Auth::user();
                $isSuperAdmin = isSuperAdmin();
                if($user->can('role-edit') ||  $isSuperAdmin)
                { 
                $btn = $btn.'<a class="me-3 text-primary cursor-pointer"  href="' . url("/roles/role-edit", $row->id) . '" data-toggle="tooltip" title="Edit"  ><i class="mdi mdi-pencil fs-5"></i></a>';
                }
                if($user->can('role-delete') ||  $isSuperAdmin)
                { 
                $btn = $btn.'<a href="javascript:void(0);" onclick=delete_record('.$row->id.') class="me-3 text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-20"></i></a>
                                                 <input id="delete_url_'.$row->id.'"  type="hidden" value="' . url('/roles/role-delete') . '" >';
                }
                $btn.'</div>';
                 return $btn;
            })
            ->rawColumns(['actions'])
            ->make(TRUE);
    }
    public function create()
    {
        $permissions=SpatiePermission::where('parent_id',0)->with('children')->get();
        $pagetitle   = "Roles";
        $breadcrumbs = ["Dashboard", "Roles" ,"Create Roles"];
        $urls        = ["/",'/roles/role-list', 'roles/role-create'];
        return view('roles.create', compact('permissions','pagetitle', 'breadcrumbs', 'urls'));
    }
    public function store(Request $request)
    {
        $messages = [
            'role_name.required' => 'Role name is required',
            'role_name.unique' => 'The role name has already been taken',
            'role_name.max' => 'Maximum length of 150 characters for role name is exceeded',
            'role_name.string' => 'You can only enter a to z alphabets',
        ];
        $rulesList=[
            'role_name' => 'required|string|max:150|unique:roles,name,',
        ];
        $validator = Validator::make($request->all(), $rulesList, $messages);
        if ($validator->fails()) {
            return redirect('roles/role-create')
                        ->withErrors($validator)
                        ->withInput();
        }
        $selected_permissions=explode(',', $request->selected_permissions);
        $role=new SpatieRole;
        $role->name=$request->role_name;
        $role->guard_name = 'web';
        $role->created_by=Auth::user()->id;
        $role->updated_by=Auth::user()->id;
        $role->save();
        $permissions=SpatiePermission::where('guard_name', 'web' )->whereIn('id',$selected_permissions)->pluck('id');
        $role->syncPermissions($permissions);
        return redirect('roles/role-list')->with('alert-success', 'Roles Created Successfully');
    }
    public function edit($id)
    {
        $role=SpatieRole::where('id',$id)->first();
        $permissions=SpatiePermission::where('parent_id',0)->with('children')->get();
        $pagetitle   = "Roles";
        $breadcrumbs = ["Dashboard", "Roles" ,"Edit Roles"];
        $urls        = ["/",'/roles/role-list', 'roles/role-edit/'.$id];
        return view('roles.edit', compact('role','permissions','pagetitle', 'breadcrumbs', 'urls'));
        
    }
    public function update(Request $request)
    {
        $messages = [
            'role_name.required' => 'Role name is required',
            'role_name.unique' => 'The role name has already been taken',
            'role_name.max' => 'Maximum length of 150 characters for role name is exceeded',
            'role_name.string' => 'You can only enter a to z alphabets',
        ];
        $rulesList=[
            'role_name' => 'required|string|max:150|unique:roles,name,'.$request->id,
        ];
       
        $validator = Validator::make($request->all(), $rulesList, $messages);
        if ($validator->fails()) {
            return redirect('roles/role-edit/'.$request->id)
                        ->withErrors($validator)
                        ->withInput();
        }
        $role=SpatieRole::where('id',$request->id)->first();
        $role->name=$request->role_name;
        $role->guard_name = 'web';
        $role->updated_by=Auth::user()->id;
        $role->save();
        $selected_permissions=explode(',', $request->selected_permissions);     
        $permissions=SpatiePermission::where('guard_name', 'web')->whereIn('id',$selected_permissions)->pluck('id');
        $role->syncPermissions($permissions);
        return redirect('roles/role-list')->with('alert-success', 'Roles Updated Successfully');   
        
    }
    public function destroy(Request $request)
    {
        $id = $request->id;
        $role=SpatieRole::find($id);
        $role->delete();
        return $role;
    }
}