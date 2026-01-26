<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Office;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\SpatieRole;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:users-list', ['only' => ['index', 'getData']]);
        $this->middleware('permission:users-create', ['only' => ['create','store']]);
        $this->middleware('permission:users-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:users-delete', ['only' => ['destroy']]);
        $this->middleware('permission:users-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle   = "Users";
        $breadcrumbs = ["Dashboard", "Users"];
        $urls        = ['/home', 'users'];
        return view('users.index', compact('pagetitle', 'breadcrumbs', 'urls'));
    }

    public function getData()
    {
        $users    = User::where('id','<>',0);
        return DataTables::of($users)
            ->addColumn('actions', function ($users)
            {
                $actions = "<div class='btn-toolbar'>";
                $actions .= "</div>";
                return $actions;
            })
            ->addColumn('created_at', function ($users) {

                return Carbon::parse($users->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('updated_at', function ($users) {
                
                return Carbon::parse($users->updated_at)->format('d-m-Y H:i:s');
               
            })
          
            ->addColumn('actions', function($row){
            
                $btn = "<div class='btn-toolbar'>";
                $user = Auth::user();
                $isSuperAdmin = isSuperAdmin();
                if($user->can('users-edit') ||  $isSuperAdmin)
                { 
                $btn = $btn.'<a class="me-3 text-primary cursor-pointer"  href="' . url("/users/edit", $row->id) . '" data-toggle="tooltip" title="Edit"  ><i class="mdi mdi-pencil font-size-20"></i></a>';
                }
                // if($user->can('users-delete') ||  $isSuperAdmin)
                // { 
                // $btn = $btn.'<a href="javascript:void(0);" onclick=delete_record('.$row->id.') class="me-3 text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-20"></i></a>
                //                                  <input id="delete_url_'.$row->id.'"  type="hidden" value="' . url('/users/delete') . '" >';
                // }
                $btn.'</div>';
                 return $btn;
            })
            ->rawColumns(['actions'])
            ->make(TRUE);
    }

    public function create()
    {
        $roles = SpatieRole::where('id','!=',4)->get();
        $users=User::get();
        $pagetitle = "Create New User";
        $breadcrumbs = ["Home","Users", 'Create New User'];
        $urls        = ["/",'/users/', 'users/create'];
        return view('users.create', compact('pagetitle', 'breadcrumbs', 'urls','roles'));
    }
    public function save(Request $request)
    {
       // dd($request);
        $validator = $this->create_validator($request->all());
       // dd($validator);
       //dd($validator->fails());
        if ($validator->fails()){
          
            return redirect('users/create')
            ->withErrors($validator)
            ->withInput();
        }
       
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $request->get('name');
            $user->username=$request->get('username');
            if ($request->get('email') != '')
            {
                $user->email = $request->get('email');
            }
            $user->contact_number = ($request->get('contact') != '' ? $request->get('contact') : '');
            if ($request->get('password') != ''){
                $user->password = bcrypt($request->get('password'));
            }
            $user->save();
            $user_id = $user->id;
            $user->syncRoles($request->get('roles'));
            $user_id = $user->id ;
            //insert user clients
          
        //insert user projects
          
            //insert programs projects
          
            DB::commit();
            return redirect('users')->with('alert-success', 'User Created Successfully');
        }
        catch(Exception $e){
            DB::rollback();

             dd($e->getMessage());
           
            return redirect('users')->with('alert-error', 'User Creation Failed');
        }
    
    }

    protected function create_validator(array $data)
    {
        $messages = [
            'name.required' => 'Name is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must not be less then 6 digts',
            'password.confirmed' => 'Password and confirm password must be same',
            'roles.required' => 'Please select any role',
        ];
        return Validator::make($data, [
            'name'   => 'required',          
            'password'   => 'required|min:6|confirmed',
            'roles'      => 'required',
        ] , $messages );
    }
    protected function update_validator(array $data, $id = 0)
    {
        $messages = [
            'name.required' => 'Name is required',
            
            'roles.required' => 'Please select any role',
           
        ];
        return Validator::make($data, [
            'name'   => 'required',
            'roles'      => 'required',
        ] , $messages );
    }

    public function edit($id)
    {
        $roles = SpatieRole::where('id','!=',4)->get();
        $users=User::where('id','!=',$id)->get();
        $user=User::where('id',$id)->with('roles')->first();
        $pagetitle = "Edit New User";
        $breadcrumbs = ["Home","Users", 'Edit New User'];
        $urls        = ["/",'/users/', 'users/edit'];
        return view('users.edit', compact('pagetitle', 'breadcrumbs', 'urls','roles','users','user'));

    }

    public function update(Request $request)
    {
        $user=User::where('id',$request->id)->first();
        $validator = $this->update_validator($request->all(), $user->id);
        if ($validator->fails()){
            return redirect('users/edit/'.$request->id)
            ->withErrors($validator)
            ->withInput();
        }
        
        DB::beginTransaction();
        try {
            $user->name = $request->get('name');
            if ($request->get('email') != '')
            {
                $user->email = $request->get('email');
            }
            $user->contact = ($request->get('contact') != '' ? $request->get('contact') : '');
            if ($request->get('password') != ''){
                $user->password = bcrypt($request->get('password'));
            }
            $user->save();

            if($request->get('roles')){
                $user->syncRoles($request->get('roles'));
            }
            $user_id = Auth::user()->id;
            DB::commit();
            return redirect('users')->with('alert-success', 'User Updated Successfully');
        }
        catch (Expection $e)
        {
            DB::rollback();
            // dd($e->getMessage());
           
            return redirect('users')->with('alert-error', 'User Creation Failed');
        }
    }
}