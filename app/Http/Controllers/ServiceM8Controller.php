<?php

namespace App\Http\Controllers;

use App\Services\ServiceM8\ServiceM8Service;
use Illuminate\Http\Request;

use Yajra\DataTables\Facades\DataTables;
use Auth;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\UserCreatedMail;
class ServiceM8Controller extends Controller
{
    protected ServiceM8Service $service;

    public function __construct(ServiceM8Service $service)
    {
        $this->service = $service;
    }

    /**
     * Get all clients
     */
    // public function clients(Request $request)
    // {
    //     $clients = $this->service->getClients($request->all());
    //     dd($clients);
    //     return response()->json([
    //         'success' => true,
    //         'data' => $clients
    //     ]);
    // }
    public function createUserFromCompany(Request $request)
    {
        try{
            $companyUUID = $request->company_uuid;
            
            if (!$companyUUID) {
                return response()->json([
                    'status' => false,
                    'message' => 'Company UUID missing'
                ], 400);
            }
            $company_contact = $this->service->getCompanyContact([
                '$filter' => "company_uuid eq '$companyUUID'",
            ]);
            if (!empty($company_contact)) {
                $company_contact = collect($company_contact)->firstWhere('is_primary_contact', '1');
            }
            if(count($company_contact) > 0)
            {    
                // Example dummy email
                $contactEmail = $company_contact['email'];
            //   $contactEmail='rasoolkhizer1@gmail.com';
                $contactName   = $company_contact['first'] ." ".$company_contact['last'];             
                $contactPhone = $company_contact['mobile'];

                if (!$contactEmail) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Company email not found'
                    ], 404);
                }
                $existingUser = User::where('email', $contactEmail)->first();
                $generatedPassword="password";
                if($existingUser)
                {
                    $existingUser->password = Hash::make('password');
                    $existingUser->save();
                    $user=$existingUser;
                }
            
                if(!$existingUser)
                {
                    $username = Str::slug($contactName) . rand(100,999);
                // Create a new user instance
                    $user = new User();
                    $user->username = $username;
                    $user->name = $contactName;
                    $user->contact_number = $contactPhone;
                    $user->email = $contactEmail;
                    $user->type = 'client';
                    $user->servicem8_company_uuid = $companyUUID;
                    $user->password = Hash::make('password');
                    $user->created_at = time();
                    $user->updated_at = time();
                    $user->is_active = 'Yes';
                    $user->password_reset_required = 'Yes';

                    // Save to database
                    $user->save();
                }
                $loginUrl = 'https://portal.tomspestcontrol.com.au/login';
                Mail::to($contactEmail)->send(new UserCreatedMail($contactEmail, $generatedPassword, $loginUrl));
                return response()->json([
                    'status' => true,
                    'message' => 'User created successfully',
                    'user_id' => $user->id
                ]);
            }
        }
            catch (\Exception $e) {
             return response()->json([
                'status' => 'error',
                'message' => 'Exception occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

        public function clients(Request $request)
        {
            $pagetitle   = "Clients";
            $breadcrumbs = ["Dashboard", "Clients"];
            $urls        = ['/home', '/servicem8/clients'];

            if ($request->ajax()) {

                // Fetch clients safely from ServiceM8 (use filtering to avoid timeout)
              $tenDaysAgo = date('Y-m-d', strtotime('-10 days'));

                $clients = $this->service->getClients([
                    '$filter' => "edit_date gt '{$tenDaysAgo}'"
                ]);
                return DataTables::of($clients)
                ->addColumn('initials', function ($client) {
                    $name = $client['name'] ?? '';
                    $parts = explode(' ', $name);
                    return strtoupper(
                        substr($parts[0] ?? '', 0, 1) .
                        substr($parts[1] ?? '', 0, 1)
                    );
                })
                ->editColumn('name', fn ($c) => $c['name'] ?? '—')
                ->editColumn('abn_number', fn ($c) => $c['abn_number'] ?: '—')
                ->editColumn('address', fn ($c) =>
                    implode(', ', array_filter([
                        $c['address_street'] ?? '',
                        $c['address_city'] ?? '',
                        $c['address_state'] ?? '',
                        $c['address_postcode'] ?? '',
                        $c['address_country'] ?? ''
                    ])) ?: ($c['address'] ?? '—')
                )
                ->editColumn('billing_address', fn ($c) => $c['billing_address'] ?: '—')
                ->editColumn('website', fn ($c) => $c['website'] ?: '—')
                ->editColumn('is_individual', fn ($c) => $c['is_individual'] ? 'Individual' : 'Company')
                ->editColumn('fax_number', fn ($c) => $c['fax_number'] ?: '—')
                ->editColumn('badges', fn ($c) => $c['badges'] ?: '—')
                ->editColumn('tax_rate_uuid', fn ($c) => $c['tax_rate_uuid'] ?: '—')
                ->editColumn('billing_attention', fn ($c) => $c['billing_attention'] ?: '—')
                ->editColumn('payment_terms', fn ($c) => $c['payment_terms'] ?: '—')
                ->editColumn('active', fn ($c) =>
                    $c['active'] ? '<span class="badge bg-success">Active</span>' : '<span class="badge bg-danger">Inactive</span>'
                )
                ->editColumn('edit_date', fn ($c) => $c['edit_date'] ?? '—')
               ->addColumn('actions', function ($c) {
                return '
                    <a href="' . route('company.clientJobs', $c['uuid']) . '"
                       class="btn btn-sm btn-primary">
                        View
                    </a>
                    ';
                })
                ->rawColumns(['active', 'actions'])
                ->make(true);
            }
            
            return view('servicem8.clients.index', compact('pagetitle', 'breadcrumbs', 'urls'));
        }


    public function clientJobs(Request $request, string $companyUuid)
    {
        $pagetitle   = "Clients JObs";
        $breadcrumbs = ["Dashboard","Clients","Clients Jobs"];
        $urls        = ['/home', '/servicem8/clients','/jobs'];

        // Fetch jobs for this company
        $jobs = $this->service->getJobs([
            '$filter' => "company_uuid eq '$companyUuid'",
            '$orderby' => 'date desc'
        ]);
        
        $zeroDate = '0000-00-00 00:00:00';
        // Split jobs
   $completedJobs = collect($jobs)
    ->filter(function ($job) use ($zeroDate) {

        $completionDate   = $job['completion_date'] ?? null;
        $unsuccessfulDate = $job['unsuccessful_date'] ?? null;

        return (
            (!empty($completionDate) && $completionDate !== $zeroDate)
            || ($job['status'] ?? null) === 'Unsuccessful'
            || (!empty($unsuccessfulDate) && $unsuccessfulDate !== $zeroDate)
        );
    })
    ->sortByDesc(function ($job) use ($zeroDate) {

        $completionDate   = $job['completion_date'] ?? null;
        $unsuccessfulDate = $job['unsuccessful_date'] ?? null;

        if (!empty($completionDate) && $completionDate !== $zeroDate) {
            return $completionDate;
        }

        return $unsuccessfulDate;
    })
    ->values();
       $upcomingJobs = collect($jobs)->filter(function ($job) {
            return (
                empty($job['completion_date']) 
                || $job['completion_date'] === '0000-00-00 00:00:00'
            )
            && ( empty($job['unsuccessful_date']) 
                || $job['unsuccessful_date'] === '0000-00-00 00:00:00'
            )
            && !empty($job['work_order_date']);
        });
        
      //  dd($completedJobs);
      $type=Auth::user()->type;
        return view('servicem8.clientJobs.index', compact(
         //   'client'        => $client,
            'completedJobs',
            'upcomingJobs',
            'pagetitle', 'breadcrumbs', 'urls','type','companyUuid'
        ));
    }

    // public function showJob($uuid)
    // {
    //     // Fetch single job
    //     $job = $this->service->getJob($uuid);
    //     $attachments = $this->service->getJobAttachments($uuid);
    //     dd($attachments);
    //     if (!$job) {
    //         abort(404);
    //     }

    //     return view('servicem8.jobs.show', compact('job'));
    // }

   public function downloadAttachment(string $uuid)
{
    $fileContent = $this->service->downloadAttachmentStream($uuid);
    
    // Optional: fetch metadata to get the proper filename and extension
    $meta = $this->service->getAttachment($uuid); // returns array
    
    $attachment = $meta ?? [];
    $fileName = $attachment['attachment_name'] ?? $uuid;
    $fileType = $attachment['file_type'] ?? '';
    
    $contentType = match(strtolower($fileType)) {
        '.pdf' => 'application/pdf',
        '.jpg', '.jpeg' => 'image/jpeg',
        '.png' => 'image/png',
        '.gif' => 'image/gif',
        '.doc', '.docx' => 'application/msword',
        '.xls', '.xlsx' => 'application/vnd.ms-excel',
        '.txt' => 'text/plain',
        default => 'application/octet-stream',
    };
    
    return response($fileContent, 200)
        ->header('Content-Type', $contentType)
        ->header('Content-Disposition', 'attachment; filename="' . $fileName . $fileType . '"')
        ->header('Content-Length', strlen($fileContent));
}



    public function showJob(string $jobUuid)
    {
        $job = $this->service->getJob($jobUuid); // your existing job fetch
      //  dd($job);
        $cursor = '-1';
        $attachments = [];

        while(count($attachments) < 20 && $cursor) {
            $res = $this->service->getJobAttachments($jobUuid, $cursor); 
            $attachments = array_merge($attachments, $res['attachments'] ?? []);
            $cursor = $res['x-next-cursor'] ?? null;
        }

        $attachments = array_slice($attachments, 0, 20);
        $type=Auth::user()->type;
        return view('servicem8.jobs.show', [
            'job' => $job,
            'attachments' => $attachments,
            'nextCursor' => $cursor,
            'type'=>$type,
        ]);
    }

    /**
     * Get staff
     */
    public function staff(Request $request)
    {
        $pagetitle   = "Staffs";
        $breadcrumbs = ["Dashboard", "Staffs"];
        $urls        = ['/home', '/servicem8/staff'];
       if ($request->ajax()) {

            $staffs = $this->service->getStaff();

            return DataTables::of($staffs)
                ->addColumn('name', function ($staff) {
                    return trim(($staff['first'] ?? '') . ' ' . ($staff['last'] ?? ''));
                })

                ->addColumn('initials', function ($staff) {
                    return strtoupper(
                        substr($staff['first'] ?? '', 0, 1) .
                        substr($staff['last'] ?? '', 0, 1)
                    );
                })

                ->editColumn('email', fn ($staff) =>
                    $staff['email'] ?: '—'
                )

                ->editColumn('mobile', fn ($staff) =>
                    $staff['mobile'] ?: '—'
                )

                ->editColumn('job_title', fn ($staff) =>
                    $staff['job_title'] ?: '—'
                )

                ->editColumn('active', fn ($staff) =>
                    $staff['active']
                )

                ->editColumn('hide_from_schedule', fn ($staff) =>
                    $staff['hide_from_schedule']
                )

                ->editColumn('can_receive_push_notification', fn ($staff) =>
                    $staff['can_receive_push_notification']
                )

                ->editColumn('color', fn ($staff) =>
                    $staff['color']
                )

                ->editColumn('edit_date', fn ($staff) =>
                    $staff['edit_date']
                )

                // ->addColumn('actions', function ($staff) {
                //     return '
                //         <div class="dropdown">
                //             <a href="#" class="btn btn-sm btn-soft-primary dropdown-toggle"
                //                data-bs-toggle="dropdown">
                //                 Actions
                //             </a>
                //             <div class="dropdown-menu dropdown-menu-end">
                //                 <a href="#" class="dropdown-item">
                //                     <i class="ri-eye-line me-1"></i> View
                //                 </a>
                //             </div>
                //         </div>
                //     ';
                // })
                ->addColumn('actions', function ($staff) {

                        // Make sure the route exists in web.php
                        $jobsUrl = route('servicem8.jobs', [
                            'staff_uuid' => $staff['uuid'] // pass the staff UUID
                        ]);

                        return '
                            <div class="dropdown">
                                <a href="#" class="btn btn-sm btn-soft-primary dropdown-toggle"
                                data-bs-toggle="dropdown">
                                    Actions
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="'.$jobsUrl.'" class="dropdown-item">
                                        <i class="ri-briefcase-line me-1"></i> View Jobs
                                    </a>
                                </div>
                            </div>
                        ';
                    })


                ->rawColumns(['actions'])
                ->make(true);
        }

        // Page load
        return view('servicem8.staff.index',compact('pagetitle', 'breadcrumbs', 'urls')
        );
    }
    

    /**
     * Get jobs
     */
    // public function jobs(Request $request)
    // {
    //     $jobs = $this->service->getJobs($request->all());
    //     dd($jobs);
    //     return response()->json([
    //         'success' => true,
    //         'data' => $jobs
    //     ]);
    // }
    // public function jobs(Request $request)
    // {
    //     $pagetitle   = "Jobs";
    //     $breadcrumbs = ["Dashboard", "Jobs"];
    //     $urls        = ['/home', '/servicem8/jobs'];

    //     if ($request->ajax()) {

    //         // DataTables pagination
        

    //         // Filters
    //         $status   = $request->get('status');
    //         $dateFrom = $request->get('date_from', '2026-01-01');

    //         // Base filter (MANDATORY)
    //         $filter = "edit_date gt '{$dateFrom}'";

    //         // Optional status filter
    //         if (!empty($status)) {
    //             $filter .= " and status eq '{$status}'";
    //         }

    //         // ServiceM8 params
    //         $params = [
    //             '$orderby' => 'edit_date desc',
    //             '$filter'  => $filter
    //         ];
           

    //         $jobs = $this->service->getJobs($params);

    //         return DataTables::of($jobs)

    //             ->editColumn('generated_job_id', fn ($job) =>
    //                 $job['generated_job_id'] ?? '—'
    //             )

    //             ->editColumn('status', fn ($job) =>
    //                 $job['status'] ?? '—'
    //             )

    //             ->editColumn('job_address', fn ($job) =>
    //                 $job['job_address'] ?? '—'
    //             )

    //             ->editColumn('total_invoice_amount', fn ($job) =>
    //                 $job['total_invoice_amount'] ?? '—'
    //             )

    //             ->editColumn('payment_received', fn ($job) =>
    //                 !empty($job['payment_received'])
    //                     ? '<span class="badge bg-success">Yes</span>'
    //                     : '<span class="badge bg-secondary">No</span>'
    //             )

    //             ->editColumn('completion_date', fn ($job) =>
    //                 $job['completion_date'] ?? '—'
    //             )

    //             ->editColumn('edit_date', fn ($job) =>
    //                 $job['edit_date'] ?? '—'
    //             )

    //             ->addColumn('actions', function () {
    //                 return '
    //                     <div class="dropdown">
    //                         <a href="#" class="btn btn-sm btn-soft-primary dropdown-toggle"
    //                         data-bs-toggle="dropdown">
    //                             Actions
    //                         </a>
    //                         <div class="dropdown-menu dropdown-menu-end">
    //                             <a href="#" class="dropdown-item">
    //                                 <i class="ri-eye-line me-1"></i> View
    //                             </a>
    //                         </div>
    //                     </div>
    //                 ';
    //             })

    //             ->rawColumns(['payment_received', 'actions'])
    //             ->make(true);
    //     }

    //     return view('servicem8.jobs.index', compact(
    //         'pagetitle',
    //         'breadcrumbs',
    //         'urls'
    //     ));
    // }

  
    public function jobs(Request $request)
    {
        $pagetitle   = "Jobs";
        $breadcrumbs = ["Dashboard", "Jobs"];
        $urls        = ['/home', '/servicem8/jobs'];

        if ($request->ajax()) {

            $filters = [];

            // 🔹 Date filter (fixed from Jan 1, 2026)
           $tenDaysAgo = date('Y-m-d', strtotime('-7 days'));

            $filters[] = "edit_date gt '{$tenDaysAgo}'";

            // 🔹 Staff filter
            if ($request->filled('staff_uuid')) {
                $filters[] = "queue_assigned_staff_uuid eq '{$request->staff_uuid}'";
            }

            // 🔹 Status filter
            if ($request->filled('status')) {
                $filters[] = "status eq '{$request->status}'";
            }

            $params = [
                '$orderby' => 'edit_date desc',
                '$filter'  => implode(' and ', $filters),
            ];
            $jobs = $this->service->getJobs($params);

            return DataTables::of($jobs)

                ->editColumn('generated_job_id', fn ($job) =>
                    $job['generated_job_id'] ?? '—'
                )

                ->editColumn('status', fn ($job) =>
                    ucfirst($job['status'] ?? '—')
                )

                ->editColumn('job_address', fn ($job) =>
                    $job['job_address'] ?? '—'
                )

                ->editColumn('total_invoice_amount', fn ($job) =>
                    $job['total_invoice_amount'] ?? '—'
                )

                ->editColumn('payment_received', fn ($job) =>
                    !empty($job['payment_received'])
                        ? '<span class="badge bg-success">Yes</span>'
                        : '<span class="badge bg-secondary">No</span>'
                )

                ->editColumn('completion_date', fn ($job) =>
                    $job['completion_date'] ?? '—'
                )

                ->editColumn('edit_date', fn ($job) =>
                    $job['edit_date']
                )

                ->addColumn('actions', function ($job) {
                    return '
                        <a href="' . route('servicem8.jobs.show', $job['uuid']) . '" class="btn btn-sm btn-soft-primary">
                            View
                        </a>
                    ';
                })

                ->rawColumns(['payment_received', 'actions'])
                ->make(true);
        }
        $date = date('Y-m-d', strtotime('-10 days'));
        $current_date=date('Y-m-d');
        return view('servicem8.jobs.index', compact(
            'pagetitle',
            'breadcrumbs',
            'urls',
            'date',
            'current_date'
        ));
    }




    /**
     * Get single job
     */
    public function job(string $uuid)
    {
        $job = $this->service->getJob($uuid);

        return response()->json([
            'success' => true,
            'data' => $job
        ]);
    }

    /**
     * Get quotes
     */
    public function quotes(Request $request)
    {
        $quotes = $this->service->getQuotes($request->all());

        return response()->json([
            'success' => true,
            'data' => $quotes
        ]);
    }

    /**
     * Get invoices
     */
    public function invoices(Request $request)
    {
        $invoices = $this->service->getInvoices($request->all());

        return response()->json([
            'success' => true,
            'data' => $invoices
        ]);
    }

    /**
     * Get job attachments
     */
    public function attachments(string $uuid)
    {
        $attachments = $this->service->getJobAttachments($uuid);

        return response()->json([
            'success' => true,
            'data' => $attachments
        ]);
    }
}
