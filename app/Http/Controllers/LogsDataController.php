<?php

namespace App\Http\Controllers;
use App\Models\CMSEvent;
use App\Models\CPEvent;
use App\Models\CSREvent;
use App\Models\LogData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Exception;
use Validator;
use Yajra\DataTables\DataTables;
use Arr;
use Illuminate\Contracts\Validation\Rule;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class LogsDataController extends Controller
{
    private $cp_event_instance, $cms_event_instance, $csr_event_instance;
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:cp-log-list', ['only' => ['index','cpajaxLogsData']]);
        $this->middleware('permission:cms-log-list', ['only' => ['cmsIndex','cmsAjaxLogsData']]);
        $this->middleware('permission:csr-log-list', ['only' => ['csrIndex','csrAjaxLogsData']]);

        $this->cp_event_instance = new CPEvent();
        $this->cms_event_instance = new CMSEvent();
        $this->csr_event_instance = new CSREvent();
    }
   public function index()
    {
         $pagetitle   = __("CP Logs Data");
        $breadcrumbs = [__('Dashboard'), __("CP Logs list")];
        $urls        = ['/', 'CP Logs Data/CP Logs list'];
        $clients = getUserClients();
        $projects = getUserProjects();
        return view('logs_data.cp.index',compact('pagetitle', 'breadcrumbs', 'urls','clients','projects'));
    }
    public function cpAjaxLogsData(Request $request)
    {
        $clientIds = $request->input('client_id');
        $projectId = $request->input('project_id');
        $start_date = strtotime($request->start_date);
        $end_date = strtotime($request->end_date);
        $module_name = $request->input('module_name');
        $users = getcpUsersArray($projectId);
        $project_db_prefix = config('app.project_db_prefix');
        $databaseName = $project_db_prefix . $projectId;

        $query = $this->cp_event_instance->setTable($databaseName . '.cp_events')->where('created_at', '>', $start_date)
            ->where('created_at', '<', $end_date);
          if (!empty($module_name)) {
                $query->where('module_name', $module_name);
            }
        $logs = $query->get();

        return DataTables::of($logs)
            ->editColumn('created_by', function ($log) use ($users) {
                return $users[$log->created_by] ?? 'Unknown';
            })
            ->addColumn('created_at', function ($log) {
                return Carbon::parse($log->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('module_name', function ($log) {
                return $log->module_name;
            })
            ->rawColumns(['created_by'])
            ->make(true);
    }
    public function cmsIndex()
    {
        $pagetitle   = __("CMS Logs Data");
        $breadcrumbs = [__('Dashboard'), __("CMS Logs list")];
        $urls        = ['/', 'CMS Logs Data/CMS Logs list'];
        $clients = getUserClients();
        $projects = getUserProjects();
        return view('logs_data.cms.index', compact('pagetitle', 'breadcrumbs', 'urls', 'clients', 'projects'));
    }

    public function cmsAjaxLogsData(Request $request)
    {
        $clientIds = $request->input('client_id');
        $projectId = $request->input('project_id');
        $start_date = strtotime($request->start_date);
        $end_date = strtotime($request->end_date);
        $module_name = $request->input('module_name');
        $users = getCmsUsersArray($projectId);
        $project_db_prefix = config('app.project_db_prefix');
        $databaseName = $project_db_prefix . $projectId;

        $query = $this->cms_event_instance->setTable($databaseName . '.cms_events')->where('created_at', '>', $start_date)
            ->where('created_at', '<', $end_date);

      if (!empty($module_name)) {
            $query->where('module_name', $module_name);
        }
        $logs = $query->get();

        return DataTables::of($logs)
            ->editColumn('created_by', function ($log) use ($users) {
                return $users[$log->created_by] ?? 'Unknown';
            })
            ->addColumn('created_at', function ($log) {
                return Carbon::parse($log->created_at)->format('d-m-Y H:i:s');
            })
            ->addColumn('module_name', function ($log) {
                return $log->module_name;
            })
            ->rawColumns(['created_by'])
            ->make(true);
    }

    public function csrIndex()
    {
        $pagetitle   = __("CSR Logs Data");
        $breadcrumbs = [__('Dashboard'), __("CSR Logs list")];
        $urls        = ['/', 'CSR Logs Data/CSR Logs list'];
        $clients = getUserClients();
        $projects = getUserProjects();
        return view('logs_data.csr.index', compact('pagetitle', 'breadcrumbs', 'urls', 'clients', 'projects'));
    }

    public function csrAjaxLogsData(Request $request)
    {
        $clientIds = $request->input('client_id');
        $projectId = $request->input('project_id');
        $start_date = strtotime($request->start_date);
        $end_date = strtotime($request->end_date);
        $csr_extension = $request->input('csr_extension');
        $module_name = $request->input('module_name');
        $users = getCsrUsersArray($projectId);
        $project_db_prefix = config('app.project_db_prefix');
        $databaseName = $project_db_prefix . $projectId;

        $logs= $this->csr_event_instance->setTable($databaseName . '.csr_events')->where('created_at','>',$start_date)->where('created_at','<',$end_date);

        if (!empty($module_name)) {
            $logs->where('module_name', $module_name);
        }
        if (!empty($csr_extension)) {
            $filteredUserIds = array_keys(array_filter($users, function ($user) use ($csr_extension) {
                return $user->csr_extension == $csr_extension;
            }));

            if (!empty($filteredUserIds)) {
                $logs->whereIn('created_by', $filteredUserIds);
            } else {
                return DataTables::of([])->make(true);
            }
        }
        return DataTables::of($logs)
            ->editColumn('created_by', function ($log) use ($users) {
                return $users[$log->created_by]->csr_name ?? 'Unknown';
            })
            ->addColumn('csr_extension', function ($log) use ($users) {
                return $users[$log->created_by]->csr_extension ?? 'Unknown';
            })
            ->addColumn('module_name', function ($log) {
                return $log->module_name ?? 'N/A';
            })
            ->addColumn('created_at', function ($log) {
                return Carbon::parse($log->created_at)->format('d-m-Y H:i:s');
            })
            ->rawColumns(['created_by'])
            ->make(true);
    }
}