@extends($type == 'client' ? 'layouts.app1' : 'layouts.master')

@section('css')
@if($type != 'client')
    @include('layouts.datatable_css')
@endif
@endsection

@section('content')

<div class="max-w-7xl mx-auto">

    @if($type === 'client')
        <div class="mb-6">
            <a href="{{ route('dashboard-index') }}" class="text-toms-green hover:underline">
                ← Back to Dashboard
            </a>
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg p-6">

        <!-- Header -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Site Documentation</h2>

            <div class="flex items-center space-x-3">
                <!-- Toggle view -->
                <button onclick="toggleViewMode()" class="p-2 text-gray-600 hover:text-toms-green hover:bg-gray-100 rounded">
                    <svg id="gridIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h4v4H4V6zm6 0h4v4h-4V6zm6 0h4v4h-4V6z
                                 M4 12h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z
                                 M4 18h4v4H4v-4zm6 0h4v4h-4v-4zm6 0h4v4h-4v-4z"/>
                    </svg>
                    <svg id="listIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>

                <!-- New Folder -->
                <button onclick="showCreateFolderModal()"
                        class="bg-toms-green hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    + New Folder
                </button>

                <!-- Upload File -->
                <button onclick="openUploadModal()"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium inline-flex items-center">
                    Upload File
                </button>
            </div>
        </div>

        <!-- Breadcrumb -->
        <div class="mb-4 text-sm">
            <nav class="flex items-center space-x-2">
                @foreach($breadcrumb ?? [] as $folder)
                    <span class="text-gray-400">/</span>
                    <a href="{{ route('client.document.show', ['client_uuid'=>$uuid,'folderId'=>$folder->id]) }}"
                       class="text-toms-green hover:underline">
                        {{ $folder->name }}
                    </a>
                @endforeach
            </nav>
        </div>

        <!-- TAG FILTER DROPDOWN -->
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Filter by tag:</label>
            <select id="tagFilter" class="border rounded px-3 py-2 w-full max-w-xs">
                <option value="">-- Select Tag --</option>
                @foreach($tags as $tag)
                    <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- FILE MANAGER -->
          <div id="fileManager">
            @include('client.documents.folder_files')
        </div>
    </div>
</div>

<!-- CREATE FOLDER MODAL -->
<div id="createFolderModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <form action="{{ route('documents.folder.store') }}" method="POST">
            @csrf
            <input type="hidden" name="company_uuid" value="{{ $uuid }}">
            <input type="hidden" name="parent_id" value="{{ $currentFolder->id ?? '' }}">
            <input type="text" name="name" class="w-full border px-3 py-2 rounded mb-4" placeholder="Folder name" required>
            <div class="text-right">
                <button type="button" onclick="closeCreateFolderModal()">Cancel</button>
                <button class="bg-toms-green text-white px-4 py-2 rounded">Create</button>
            </div>
        </form>
    </div>
</div>

<!-- UPLOAD FILE MODAL -->
<div id="uploadFileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-full max-w-md">
        <h3 class="text-xl font-bold mb-4">Upload File</h3>
        <form action="{{ route('documents.file.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="company_uuid" value="{{ $uuid }}">
            <input type="hidden" name="folder_id" value="{{ $currentFolder->id ?? '' }}">
            <input type="file" name="file" required class="w-full border px-3 py-2 rounded mb-4">
            <input type="text" name="tags" placeholder="invoice, contract" class="w-full border px-3 py-2 rounded mb-4">
            <div class="text-right">
                <button type="button" onclick="closeUploadModal()">Cancel</button>
                <button class="bg-blue-600 text-white px-4 py-2 rounded">Upload</button>
            </div>
        </form>
    </div>
</div>

<script>
let viewMode = 'grid';

function toggleViewMode() {
    document.getElementById('gridView').classList.toggle('hidden');
}

function showCreateFolderModal() { document.getElementById('createFolderModal').classList.remove('hidden'); }
function closeCreateFolderModal() { document.getElementById('createFolderModal').classList.add('hidden'); }
function openUploadModal() { document.getElementById('uploadFileModal').classList.remove('hidden'); }
function closeUploadModal() { document.getElementById('uploadFileModal').classList.add('hidden'); }

// AJAX Tag Filter
document.getElementById('tagFilter').addEventListener('change', function(){
    let tag = this.value;
    let folderId = "{{ $currentFolder->id ?? '' }}";
    let url = "{{ route('client.document.show', ['client_uuid'=>$uuid]) }}" + (folderId ? '/' + folderId : '');
    if(tag) url += "?tag=" + tag;

    fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest' } })
        .then(res => res.text())
        .then(html => { document.getElementById('fileManager').innerHTML = html; });
});

// Clickable tags inside files
document.querySelectorAll('.tag-link').forEach(el => {
    el.addEventListener('click', function(e){
        e.preventDefault();
        document.getElementById('tagFilter').value = this.dataset.tag;
        document.getElementById('tagFilter').dispatchEvent(new Event('change'));
    });
});
</script>

@endsection
