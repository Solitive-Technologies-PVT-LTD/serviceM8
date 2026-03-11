<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ServiceM8\ServiceM8Service;
use Auth;
use App\Models\Tag;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;

class DocumentController extends Controller
{
    
    protected ServiceM8Service $service;

    public function __construct(ServiceM8Service $service)
    {
        $this->service = $service;
    }
    public function universal($folderId=null)
    {
         $currentFolder = $folderId ? Folder::findOrFail($folderId) : null;

        $folders = $currentFolder 
            ? $currentFolder->children()->get() 
            : Folder::whereNull('parent_id')->get();

        $files = $currentFolder 
            ? $currentFolder->files()->get() 
            : collect();

        // Breadcrumb
        $breadcrumb = [];
        $folder = $currentFolder;
        while ($folder) {
            array_unshift($breadcrumb, $folder);
            $folder = $folder->parent;
        }

        return view('universal1', compact('folders', 'files', 'currentFolder', 'breadcrumb'));
    }
    public function index($folderId = null)
    {
        $currentFolder = $folderId ? Folder::findOrFail($folderId) : null;

        $folders = $currentFolder 
            ? $currentFolder->children()->get() 
            : Folder::whereNull('parent_id')->get();

        $files = $currentFolder 
            ? $currentFolder->files()->get() 
            : collect();

        // Breadcrumb
        $breadcrumb = [];
        $folder = $currentFolder;
        while ($folder) {
            array_unshift($breadcrumb, $folder);
            $folder = $folder->parent;
        }

        return view('documents.index', compact('folders', 'files', 'currentFolder', 'breadcrumb'));
    }

    public function storeFolder(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:folders,id',
        ]);
        if($request->has('company_uuid'))
        {
            Folder::create($request->only('name', 'parent_id','company_uuid'));

        }
        else
        {
            Folder::create($request->only('name', 'parent_id'));
        }
        return back()->with('success', 'Folder created');
    }


public function storeFile(Request $request)
{
    $request->validate([
        'folder_id' => 'required|exists:folders,id',
        'file'      => 'required|file|max:10240', // 10MB (adjust if needed)
        'tags'      => 'nullable|string',
    ]);

    // Store file
    $uploadedFile = $request->file('file');
    $path = $uploadedFile->store('documents');

    // Create file record
    $file = File::create([
        'folder_id'   => $request->folder_id,
        'name'        => $uploadedFile->getClientOriginalName(),
        'path'        => $path,
        'mime_type'   => $uploadedFile->getClientMimeType(),
        'size'        => $uploadedFile->getSize(),
        'company_uuid'=> $request->company_uuid ?? null,
    ]);

    /**
     * Handle tags
     */
    if ($request->filled('tags')) {

        $tagIds = collect(explode(',', $request->tags))
            ->map(fn ($tag) => strtolower(trim($tag)))
            ->filter()
            ->unique()
            ->map(function ($tagName) {
                return Tag::firstOrCreate([
                    'name' => $tagName
                ])->id;
            });

        // Attach tags via pivot table
        $file->tags()->sync($tagIds);
    }

    return back()->with('success', 'File uploaded successfully');
}

    public function quoteSubmit(Request $request)
    {
        $data = $request->only(['name','email','phone','message']);
        Mail::to('rasoolkhizer1@gmail.com')->send(new ContactFormMail($data));
        return back()->with('alert-success', 'Quotation Sent Successfully');
    }

    public function download($id)
    {
        $file = File::findOrFail($id);
        return Storage::download($file->path, $file->name);
    }

    public function destroyFile($id)
    {
        $file = File::findOrFail($id);
        Storage::delete($file->path);
        $file->delete();

        return back()->with('success', 'File deleted');
    }

    public function destroyFolder($id)
    {
        $folder = Folder::findOrFail($id);
        $folder->delete(); // Cascades to children and files
        return back()->with('success', 'Folder deleted');
    }

public function clientSiteDocument($uuid, $folderId = null)
{
    $companyUuid = $uuid;

    $currentFolder = $folderId
        ? Folder::where('company_uuid', $companyUuid)->findOrFail($folderId)
        : null;

    $folders = $currentFolder
        ? $currentFolder->children()
            ->where('company_uuid', $companyUuid)
            ->get()
        : Folder::whereNull('parent_id')
            ->where('company_uuid', $companyUuid)
            ->get();

    // Eager load tags
    $files = $currentFolder
        ? $currentFolder->files()->with('tags')
            ->where('company_uuid', $companyUuid)
            ->when(request('tag'), function($q){
                $q->whereHas('tags', function($q2){
                    $q2->where('name', request('tag'));
                });
            })
            ->get()
        : collect();

    // Fetch all unique tags for filtering
    $tags = Tag::whereHas('files', function($q) use ($companyUuid){
        $q->where('company_uuid', $companyUuid);
    })->get();

    // Breadcrumb
    $breadcrumb = [];
    $folder = $currentFolder;
    while ($folder && $folder->company_uuid === $companyUuid) {
        array_unshift($breadcrumb, $folder);
        $folder = $folder->parent;
    }

    $type = Auth::user()->type == "client";
      // AJAX: return rendered HTML
    if (request()->ajax()) {
        $html = view('client.documents.folder_files', compact('folders','files','uuid'))->render();
        return $html;
    }
    return view('client.documents.index', compact(
        'folders','files','currentFolder','breadcrumb','type','uuid','tags'
    ));
}


    public function getClientInvoices($uuid)
    {
        $jobs = $this->service->getJobs([
            '$filter' => "company_uuid eq '$uuid' and status eq 'Completed'",
            '$orderby' => 'date desc'
        ]);
          $invoices = [];
        
        foreach ($jobs as $job) {
            
            $attachments = $this->service->getInvoiceAttachments($job['uuid']);

            if(!empty($attachments)){
                $invoices = array_merge($invoices, $attachments);
            }
        }   
         $type=Auth::user()->type =="client";
        return view('client.invoices.index', compact(
           'invoices','uuid','type','jobs'
        ));
        
    }

    public function clientSiteDocumentByTag($uuid, $tagName)
    {
        $companyUuid = $uuid;

        // Find tag
        $tag = Tag::where('name', $tagName)->firstOrFail();

        // No current folder needed for tag filtering
        $currentFolder = null;

        // Get folders as usual
        $folders = Folder::whereNull('parent_id')
            ->where('company_uuid', $companyUuid)
            ->get();

        // Get files with this tag only
        $files = File::with('tags')
            ->where('company_uuid', $companyUuid)
            ->whereHas('tags', function($q) use ($tag) {
                $q->where('tags.id', $tag->id);
            })
            ->get();

        return view('client.documents.index', [
            'folders' => $folders,
            'files' => $files,
            'currentFolder' => $currentFolder,
            'breadcrumb' => [],
            'type' => Auth::user()->type === 'client',
            'uuid' => $uuid,
            'currentTag' => $tag,
        ]);
    }

}
