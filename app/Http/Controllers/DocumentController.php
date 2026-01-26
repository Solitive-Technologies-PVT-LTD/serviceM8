<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
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

        Folder::create($request->only('name', 'parent_id'));

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
}
