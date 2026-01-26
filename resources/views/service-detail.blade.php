@extends('layouts.master')

@section('title', 'Service Details - Tom\'s Pest Control')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('dashboard') }}" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <h2 class="text-3xl font-bold text-gray-900 mb-2">General Pest Control</h2>

    <div class="mb-6">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Date</h3>
        <p class="text-gray-900">May 18, 2024</p>
    </div>

    <div class="mb-8">
        <h3 class="text-lg font-semibold text-gray-700 mb-1">Job Details</h3>
        <p class="text-gray-900">General pest control for residential property</p>
    </div>

    <div>
        <h3 class="text-xl font-bold text-gray-900 mb-4">Attached Documents</h3>
        
        <div class="space-y-4">
            @php
            $documents = [
                ['name' => 'Service Report', 'icon' => 'document'],
                ['name' => 'Invoice', 'icon' => 'document'],
                ['name' => 'Map', 'icon' => 'document'],
            ];
            @endphp

            @foreach($documents as $document)
            <div class="bg-white rounded-lg p-6 shadow flex items-center justify-between hover:shadow-md transition">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-blue-900 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="text-lg font-medium text-gray-900">{{ $document['name'] }}</span>
                </div>
                <button class="bg-toms-green hover:bg-green-700 text-white px-6 py-2 rounded font-medium transition">
                    Download
                </button>
            </div>
            @endforeach

            <!-- Add Document Button -->
            <div class="bg-white border-2 border-dashed border-gray-300 rounded-lg p-6 hover:border-toms-green transition cursor-pointer">
                <button onclick="document.getElementById('document-upload').click()" class="w-full flex flex-col items-center justify-center text-gray-600 hover:text-toms-green transition">
                    <svg class="w-12 h-12 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span class="font-medium text-lg">Add Document</span>
                    <span class="text-sm mt-1">Click to upload a new document</span>
                </button>
                <input type="file" id="document-upload" class="hidden" accept=".pdf,.doc,.docx,.xls,.xlsx,.jpg,.jpeg,.png" multiple>
            </div>
        </div>
    </div>

    <!-- Photos Section -->
    <div class="mt-12">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold text-gray-900">Photos</h3>
            <button onclick="openPhotoModal(0)" class="bg-toms-green hover:bg-green-700 text-white px-6 py-2 rounded-lg font-medium transition inline-flex items-center text-sm">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                View All Photos
            </button>
        </div>
        
        <!-- Horizontal Scrollable Photo Gallery -->
        <div class="overflow-x-auto pb-4 scrollbar-hide" style="scrollbar-width: none; -ms-overflow-style: none;">
            <div class="flex space-x-4" style="min-width: max-content;">
                @php
                $photos = [
                    ['id' => 1, 'url' => 'https://via.placeholder.com/300x300?text=Photo+1', 'alt' => 'Service Photo 1'],
                    ['id' => 2, 'url' => 'https://via.placeholder.com/300x300?text=Photo+2', 'alt' => 'Service Photo 2'],
                    ['id' => 3, 'url' => 'https://via.placeholder.com/300x300?text=Photo+3', 'alt' => 'Service Photo 3'],
                    ['id' => 4, 'url' => 'https://via.placeholder.com/300x300?text=Photo+4', 'alt' => 'Service Photo 4'],
                    ['id' => 5, 'url' => 'https://via.placeholder.com/300x300?text=Photo+5', 'alt' => 'Service Photo 5'],
                    ['id' => 6, 'url' => 'https://via.placeholder.com/300x300?text=Photo+6', 'alt' => 'Service Photo 6'],
                    ['id' => 7, 'url' => 'https://via.placeholder.com/300x300?text=Photo+7', 'alt' => 'Service Photo 7'],
                    ['id' => 8, 'url' => 'https://via.placeholder.com/300x300?text=Photo+8', 'alt' => 'Service Photo 8'],
                ];
                @endphp

                @foreach($photos as $index => $photo)
                <div class="relative group cursor-pointer flex-shrink-0" onclick="openPhotoModal({{ $index }})">
                    <div class="w-32 h-32 md:w-40 md:h-40 overflow-hidden rounded-lg bg-gray-200 shadow-md hover:shadow-lg transition-shadow">
                        <img src="{{ $photo['url'] }}" 
                             alt="{{ $photo['alt'] }}" 
                             data-index="{{ $index }}"
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    </div>
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity duration-300 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Photo Modal/Lightbox -->
    <div id="photoModal" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
        <button onclick="closePhotoModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <button onclick="previousPhoto()" class="absolute left-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <button onclick="nextPhoto()" class="absolute right-4 text-white hover:text-gray-300 z-10 bg-black bg-opacity-50 rounded-full p-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <div class="max-w-7xl w-full h-full flex items-center justify-center">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        </div>

        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 text-white text-sm">
            <span id="photoCounter">1 / {{ count($photos) }}</span>
        </div>
    </div>

    <script>
        const photos = @json($photos);
        let currentPhotoIndex = 0;

        function openPhotoModal(index) {
            currentPhotoIndex = index;
            updateModalImage();
            document.getElementById('photoModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePhotoModal() {
            document.getElementById('photoModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function updateModalImage() {
            const modalImage = document.getElementById('photoModal');
            const img = document.getElementById('modalImage');
            const counter = document.getElementById('photoCounter');
            
            img.src = photos[currentPhotoIndex].url;
            img.alt = photos[currentPhotoIndex].alt;
            counter.textContent = `${currentPhotoIndex + 1} / ${photos.length}`;
        }

        function nextPhoto() {
            currentPhotoIndex = (currentPhotoIndex + 1) % photos.length;
            updateModalImage();
        }

        function previousPhoto() {
            currentPhotoIndex = (currentPhotoIndex - 1 + photos.length) % photos.length;
            updateModalImage();
        }

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            const modal = document.getElementById('photoModal');
            if (!modal.classList.contains('hidden')) {
                if (e.key === 'Escape') closePhotoModal();
                if (e.key === 'ArrowRight') nextPhoto();
                if (e.key === 'ArrowLeft') previousPhoto();
            }
        });

        // Close modal when clicking outside image
        document.getElementById('photoModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePhotoModal();
            }
        });
    </script>

    <style>
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
    </style>
</div>
@endsection




