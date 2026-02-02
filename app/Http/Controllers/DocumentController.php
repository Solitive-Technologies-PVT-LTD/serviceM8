<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\ServiceM8\ServiceM8Service;
use Auth;
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
            'file' => 'required|file',
        ]);

        $uploaded = $request->file('file');
        $path = $uploaded->store('documents');

        File::create([
            'folder_id' => $request->folder_id,
            'name' => $uploaded->getClientOriginalName(),
            'path' => $path,
            'mime_type' => $uploaded->getClientMimeType(),
            'size' => $uploaded->getSize(),
            'company_uuid'=>$request->company_uuid ?? '',
        ]);

        return back()->with('success', 'File uploaded');
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

    public function clientSiteDocument($uuid,$folderId = null)
    {
       $companyUuid = $uuid; // get from auth(), request(), or route

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

        $files = $currentFolder
            ? $currentFolder->files()
                ->where('company_uuid', $companyUuid)
                ->get()
            : collect();

        // Breadcrumb
        $breadcrumb = [];
        $folder = $currentFolder;

        while ($folder && $folder->company_uuid === $companyUuid) {
            array_unshift($breadcrumb, $folder);
            $folder = $folder->parent;
        }
        $type=Auth::user()->type =="client";

        return view('client.documents.index', compact(
            'folders',
            'files',
            'currentFolder',
            'breadcrumb',
            'type','uuid'
        ));

    }

    public function getClientInvoices($uuid)
    {
        $jobs = $this->service->getJobs([
            '$filter' => "company_uuid eq '$uuid' and status eq 'Completed'",
            '$orderby' => 'date desc'
        ]);
         $type=Auth::user()->type =="client";
        return view('client.invoices.index', compact(
           'jobs','uuid','type'
        ));
        
    }
}
