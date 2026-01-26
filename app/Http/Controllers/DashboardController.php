<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Customer;
use App\Models\Office;
use App\Models\Recieveable;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use DB;
use PhpParser\Node\Expr\New_;
use Validator;

class DashboardController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view-dashboard', ['only' => ['index','getData']]);
    }
       
    public function index()
    {
        $pagetitle    = "Dashboard";
        $breadcrumbs  = ["Dashboard"];
        $urls         = ["/"];
        return view('dashboard.index', compact('pagetitle', 'breadcrumbs', 'urls'));

    } 

    public function dashboardAjax(Request $request)
    {
        $user_id=Auth::user()->id;
        $start_date=strtotime($request->start_date);
        $end_date=strtotime($request->end_date);
        if(Auth::user()->can('view-completeReport'))
        {
            $recieveable=Recieveable::where('id','>',0)->where('created_at','>=',$start_date)
            ->where('created_at','<=',$end_date)->get();
            $office_recieable = Recieveable::groupBy('office_name')
                        ->selectRaw('count(*) as count, office_name')
                        ->where('created_at','>=',$start_date)
                        ->where('created_at','<=',$end_date)->get();
        }
        else
        {
            $recieveable=Recieveable::where(function ($query) use ($user_id) {
                $query->where('accountant_id', $user_id)
                      ->orWhere('junior_officer_id', '=', $user_id)
                      ->orWhere('senior_officer_id',$user_id)
                      ->orWhere('manager_id',$user_id);
                    })->where('created_at','>=',$start_date)
                    ->where('created_at','<=',$end_date)->get();
            $office_recieable = Recieveable::where(function ($query) use ($user_id) {
                $query->where('accountant_id', $user_id)
                      ->orWhere('junior_officer_id', '=', $user_id)
                      ->orWhere('senior_officer_id',$user_id)
                      ->orWhere('manager_id',$user_id);
                    })->groupBy('office_name') ->selectRaw('count(*) as count, office_name')
                    ->where('created_at','>=',$start_date)
                    ->where('created_at','<=',$end_date)->get();
        }
        $total_count=0;
        $open=0;
        $verified_count=0;
        $confirmed_count=0;
        $unverified_count=0;
        $unconfirmed_count=0;
        $office_arr=[];
        $count_arr=[];
        $total_amount=0;
        $open_amount=0;
        $verified_amount=0;
        $confirmed_amount=0;
        $unverified_amount=0;
        $unconfirmed_amount=0;
        foreach($recieveable as $data)
        {
            print_r((int)$data->amount ." ");
            if($data->status == "Created" || $data->status == "Open")
            {
                $open=$open + 1;
                
                $open_amount = $open_amount + (int)$data->amount;
                $total_amount=$total_amount +(int)$data->amount;
            }
            elseif($data->status == "Verified")
            {
                $verified_count = $verified_count + 1;
                $verified_amount = $verified_amount + (int)$data->amount;
                $total_amount=$total_amount +(int)$data->amount;
            }
            elseif($data->status == "Confirmed")
            {
                $confirmed_count = $confirmed_count  + 1;
                $confirmed_amount = $confirmed_amount + (int)$data->amount;
                $total_amount=$total_amount +(int)$data->amount;
            }
            elseif($data->status == "Un Verified")
            {
                $unverified_count = $unverified_count +1 ;
                $unconfirmed_amount = $unconfirmed_amount + (int)$data->amount;
                $total_amount=$total_amount +(int)$data->amount;
            }
            elseif($data->status == "Un Confirmed")
            {
                $unconfirmed_count = $unconfirmed_count + 1;
                $open_amount = $open_amount + (int)$data->amount;
                $total_amount=$total_amount +(int)$data->amount;
            }
        }

        foreach($office_recieable as $data)
        {
            array_push($office_arr,$data["office_name"]);
            array_push($count_arr,$data['count']);
        }
      
        if($confirmed_count > 0 && $total_count > 0)
        {
            $confirmed_percentage = $confirmed_count / $total_count;
            $confirmed_percentage = $confirmed_percentage * 100 ;
            $confirmed_percentage = round($confirmed_percentage , 2); 
        }
        else
        {
            $confirmed_percentage =0;
        }

        if($open > 0 && $total_count > 0)
        {
            $open_percentage = $open / $total_count;
            $open_percentage = $open_percentage * 100 ;
            $open_percentage = round($open_percentage , 2); 
        }
        else
        {
            $open_percentage =0;
        }

        if($verified_count > 0 && $total_count > 0)
        {
            $verified_percentage = $verified_count / $total_count;
            $verified_percentage = $verified_percentage * 100 ;
            $verified_percentage = round($verified_percentage , 2); 
        }
        else
        {
            $verified_percentage =0;
        }
        $total_percentage = 100;
        $data=["open_amount"=>$open_amount,"verified_amount"=>$verified_amount,"confirmed_amount"=>$confirmed_amount,
        "total_amount"=>$total_amount,"open"=>$open,"verified_count"=>$verified_count,"confirmed_count"=>$confirmed_count,
                "total"=>$total_count,"confirmed_percentage"=>$confirmed_percentage,
                "open_percentage"=>$open_percentage,"verified_percentage"=>$verified_percentage,
                "total_percentage"=>$total_percentage,"unverified_count"=>$unverified_count,"unconfirmed_count"=>$unconfirmed_count,"office_arr"=>$office_arr,"count_arr"=>$count_arr];
        $html = view('dashboard.ajax', compact('data'))->render();
        $return_data=["html"=>$html , "data"=>$data];
        return $return_data;
    }

    

     
}