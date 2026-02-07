<!-- GRID VIEW -->
<div id="gridView" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">

    @forelse($folders as $folder)
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <a href="{{ route('client.document.show',['client_uuid'=>$uuid,'folderId'=>$folder->id]) }}">
                <svg class="w-16 h-16 mx-auto text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-width="2"
                          d="M3 7a2 2 0 012-2h4l2 2h7a2 2 0 012 2v7a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
                </svg>
                <p class="mt-2 font-medium truncate">{{ $folder->name }}</p>
            </a>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500">No folders</div>
    @endforelse

    @forelse($files as $file)
        <div class="p-4 bg-white shadow rounded-lg text-center">
            <svg class="w-16 h-16 mx-auto text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-width="2" d="M7 7h10v10H7z"/>
            </svg>

            <p class="mt-2 font-medium truncate">{{ $file->name }}</p>

            <!-- TAGS (Clickable for Filtering) -->
            <div class="flex flex-wrap justify-center gap-1 mt-2">
                @foreach($file->tags as $tag)
                    <a href="javascript:void(0)"
                       data-tag="{{ $tag->name }}"
                       class="tagFilter text-xs bg-gray-100 hover:bg-toms-green hover:text-white px-2 py-1 rounded transition">
                        {{ $tag->name }}
                    </a>
                @endforeach
            </div>

            <div class="flex justify-center space-x-2 mt-3">
                <a href="{{ route('documents.file.download',$file->id) }}"
                   class="text-green-600 text-sm">Download</a>

                <form action="{{ route('documents.file.delete',$file->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-600 text-sm">Delete</button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-full text-center text-gray-500">No files</div>
    @endforelse
</div>

<!-- LIST VIEW -->
<div id="listView" class="hidden mt-6">
    <table class="w-full">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-4 py-2 text-left">Name</th>
                <th class="px-4 py-2">Type</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($folders as $folder)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        <a href="{{ route('client.document.show',['client_uuid'=>$uuid,'folderId'=>$folder->id]) }}">
                            📁 {{ $folder->name }}
                        </a>
                    </td>
                    <td class="text-center">Folder</td>
                    <td></td>
                </tr>
            @endforeach

            @foreach($files as $file)
                <tr class="border-t">
                    <td class="px-4 py-2">
                        {{ $file->name }}
                        <div class="mt-1">
                            @foreach($file->tags as $tag)
                                <a href="javascript:void(0)"
                                   data-tag="{{ $tag->name }}"
                                   class="tagFilter text-xs bg-gray-100 px-2 py-1 rounded mr-1 hover:bg-toms-green hover:text-white">
                                    {{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </td>
                    <td class="text-center">File</td>
                    <td class="text-center">
                        <a href="{{ route('documents.file.download',$file->id) }}" class="text-green-600 mr-2">Download</a>
                        <form action="{{ route('documents.file.delete',$file->id) }}" method="POST" class="inline">
                            @csrf @method('DELETE')
                            <button class="text-red-600">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
