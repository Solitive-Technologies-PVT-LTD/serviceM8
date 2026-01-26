<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Facades\Validator;
use DB;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;
use Auth;
use Illuminate\Support\Facades\Storage;
use Image;
class SettingsController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:setting-list', ['only' => ['index', 'ajaxSettingData']]);
        $this->middleware('permission:setting-create', ['only' => ['create','store']]);
        $this->middleware('permission:setting-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:setting-delete', ['only' => ['destroy']]);
        $this->middleware('permission:setting-show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pagetitle   = "Settings";
        $breadcrumbs = ["Dashboard", "Settings"];
        $urls        = ['/home', 'settings/setting-list'];
        return view('settings.index', compact('pagetitle', 'breadcrumbs', 'urls'));
    }

    public function ajaxSettingData()
    {
        $settings    = Setting::where('id','<>',0);
        return DataTables::of($settings)
            ->addColumn('actions', function ($settings)
            {
                $actions = "<div class='btn-toolbar'>";
                $actions .= "</div>";
                return $actions;
            })
            ->addColumn('created_at', function ($settings) {

                return Carbon::parse($settings->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('updated_at', function ($settings) {

                return Carbon::parse($settings->updated_at)->format('d-m-Y H:i:s');
               
            })
            ->addColumn('value',function($row){
                $value="";
                if($row->type == "text")
                {
                    $value='<td>'.$row->value.'</td>'; 
                    
                }
                else{
                   $src=asset('/storage/'.$row->value);
                    $value="<img class='rounded-circle header-profile-user' src='$src' />";
                }
                return $value;
            })
            ->addColumn('actions', function($row){
            
                $btn = "<div class='btn-toolbar'>";
                $user = Auth::user();
                $isSuperAdmin = isSuperAdmin();
                if($user->can('setting-edit') ||  $isSuperAdmin)
                { 
                $btn = $btn.'<a id="edit_setting_'.$row->id.'"  class="me-3 text-primary cursor-pointer" data-toggle="tooltip" title="Edit" onclick=edit_action('.$row->id.') ><i class="mdi mdi-pencil font-size-20"></i></a>';
                }
                if($user->can('setting-delete') ||  $isSuperAdmin){
                $btn = $btn.'<a href="javascript:void(0);" onclick=delete_record('.$row->id.') class="me-3 text-danger" data-toggle="tooltip" title="Delete"><i class="mdi mdi-trash-can font-size-20"></i></a>
                                                 <input id="delete_url_'.$row->id.'"  type="hidden" value="' . url('/settings/setting-delete') . '" >';
            }
                $btn.'</div>';
                 return $btn;
            })
            ->rawColumns(['actions','value'])
            ->make(TRUE);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rulesList=[
            'name' => 'required|string|max:150',
            'type' => 'required|string'
        ];
        if($request->id)
        {
            $rulesList['key_value'] = 'required|max:150|unique:settings'.($request->id ? ",key,$request->id" : '');
        }
        else{
            $rulesList['key_value'] = 'required|max:150|unique:settings,key';
        }
        if($request->type == "text")
        {
            $rulesList['value']= 'required|string';
        }
        else{
            if($request->id == null)
            {
                $rulesList['value']= 'mimes:jpeg,svg,jpg,png,gif|required';
            }
       
        }
        $validator = Validator::make($request->all(), $rulesList);
        if ($validator->fails()) {
            // return redirect('settings/setting-list')
            //             ->withErrors($validator)
            //             ->withInput();
            return redirect('settings/setting-list')->with('alert-error', 'There is some issue in saving data');
        }
       
        if($request->id != null)
        {
            $setting=Setting::where('id',$request->id)->first();
            

        }
        else{
          
            $setting = new Setting();
            $setting->created_by=Auth::user()->id;
        }
        if($request->type == 'text')
        {
            $setting->value = $request->value;
        }else{
            $image            = $request->file('value');
            $destination_path = 'public/settings';
            $filename = imageUpload($image,$destination_path);
            $fileName = "settings/".$filename;
            $setting->value=$fileName;
        }
            $setting->updated_by=Auth::user()->id;
            $setting->key   = $request->key_value;
            $setting->name  = $request->name;
            $setting->type  = $request->type;
            
            
        if($setting->save())
        {    
            return redirect('settings/setting-list')->with('alert-success', 'Setting Created Successfully');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        $setting = Setting::find($id);
        if(!empty($setting->value) && $setting->value == 'image')
        {
            $file = explode('/',$setting->value);
            $storage = 'app/public/settings/'.$file[1];
            $storage_files = storage_path($storage);
            unlink($storage_files);
        }
        if($setting->delete())
        {    
            return $setting;
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function get_settings_data(Request $request)
    {
        $data = '';
       return $setting = Setting::where('id',$request->settings_id)->first();
        if($setting){
            return $setting;
        }
       return $data;
    }
}
