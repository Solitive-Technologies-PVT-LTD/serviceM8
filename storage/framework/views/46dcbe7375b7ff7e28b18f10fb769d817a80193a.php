<?php $__env->startSection('css'); ?>
<?php echo $__env->make('layouts.datatable_css', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="max-w-7xl mx-auto">
    <div class="mb-6">
        <a href="<?php echo e(route('dashboard')); ?>" class="text-toms-green hover:underline">← Back to Dashboard</a>
    </div>

    <div class="bg-white rounded-lg shadow-lg p-6">
        <!-- Header with Actions -->
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-3xl font-bold text-gray-900">Site Documentation</h2>
            <div class="flex items-center space-x-3">
                <button onclick="toggleViewMode()" class="p-2 text-gray-600 hover:text-toms-green hover:bg-gray-100 rounded transition" title="Toggle View">
                    <svg id="gridIcon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                    <svg id="listIcon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
                <button onclick="showCreateFolderModal()" class="bg-toms-green hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    New Folder
                </button>
                <button onclick="document.getElementById('file-upload').click()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition inline-flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                    Upload File
                </button>
                <input type="file" id="file-upload" class="hidden" multiple onchange="handleFileUpload(event)">
            </div>
        </div>

        <!-- Breadcrumb Navigation -->
        <div class="mb-4">
            <nav class="flex items-center space-x-2 text-sm">
                <button onclick="navigateToFolder('')" class="text-toms-green hover:underline">Home</button>
                <span id="breadcrumbPath"></span>
            </nav>
        </div>

        <!-- File Manager Content -->
        <div id="fileManager" class="border border-gray-200 rounded-lg p-4 min-h-[500px]">
            <!-- Files and Folders will be loaded here -->
        </div>
    </div>
</div>

<!-- Create Folder Modal -->
<div id="createFolderModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Create New Folder</h3>
        <input type="text" id="folderName" placeholder="Enter folder name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-toms-green focus:border-transparent mb-4">
        <div class="flex justify-end space-x-3">
            <button onclick="closeCreateFolderModal()" class="px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg transition">Cancel</button>
            <button onclick="createFolder()" class="px-4 py-2 bg-toms-green hover:bg-green-700 text-white rounded-lg transition">Create</button>
        </div>
    </div>
</div>

<script>
    // File Manager State
    let currentPath = '';
    let viewMode = 'list'; // 'list' or 'grid'
    
    // Mock File System Structure for Site Documentation
    let fileSystem = {
        '': {
            folders: [
                { name: 'Service Reports', path: 'service-reports' },
                { name: 'Invoices', path: 'invoices' },
                { name: 'Audits', path: 'audits' },
                { name: 'Safety Data Sheets', path: 'safety-data-sheets' },
                { name: 'Labels', path: 'labels' },
                { name: 'Onsite Documents', path: 'onsite-documents' },
                { name: 'Site Maps', path: 'site-maps' },
                { name: 'Site Specifications', path: 'site-specifications' },
                { name: 'Licenses and Insurances', path: 'licenses-insurances' }
            ],
            files: [
                { name: 'Site Overview.pdf', size: '1.5 MB', type: 'pdf' },
                { name: 'Contact Information.docx', size: '850 KB', type: 'doc' }
            ]
        },
        'service-reports': {
            folders: [],
            files: [
                { name: 'Service Report - May 2024.pdf', size: '2.1 MB', type: 'pdf' },
                { name: 'Service Report - April 2024.pdf', size: '1.9 MB', type: 'pdf' }
            ]
        },
        'invoices': {
            folders: [],
            files: [
                { name: 'Invoice INV-0001.pdf', size: '450 KB', type: 'pdf' },
                { name: 'Invoice INV-0002.pdf', size: '520 KB', type: 'pdf' }
            ]
        },
        'audits': {
            folders: [],
            files: [
                { name: 'Safety Audit 2024.pdf', size: '3.2 MB', type: 'pdf' }
            ]
        },
        'safety-data-sheets': {
            folders: [],
            files: [
                { name: 'Chemical SDS - Product A.pdf', size: '1.2 MB', type: 'pdf' },
                { name: 'Chemical SDS - Product B.pdf', size: '980 KB', type: 'pdf' }
            ]
        },
        'site-maps': {
            folders: [],
            files: [
                { name: 'Property Layout.pdf', size: '2.5 MB', type: 'pdf' },
                { name: 'Treatment Zones.pdf', size: '1.8 MB', type: 'pdf' }
            ]
        }
    };

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        loadFolder(currentPath);
    });

    function loadFolder(path) {
        const folder = fileSystem[path] || { folders: [], files: [] };
        const fileManager = document.getElementById('fileManager');
        const breadcrumb = document.getElementById('breadcrumbPath');
        
        // Update breadcrumb
        updateBreadcrumb(path);
        
        // Clear content
        fileManager.innerHTML = '';
        
        // Render folders
        folder.folders.forEach(f => {
            fileManager.appendChild(createFolderElement(f));
        });
        
        // Render files
        folder.files.forEach(f => {
            fileManager.appendChild(createFileElement(f, path));
        });
        
        // Show empty state if no items
        if (folder.folders.length === 0 && folder.files.length === 0) {
            fileManager.innerHTML = '<div class="text-center py-12 text-gray-500"><p>This folder is empty</p></div>';
        }
    }

    function createFolderElement(folder) {
        const div = document.createElement('div');
        div.className = viewMode === 'grid' 
            ? 'inline-block w-48 m-2 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer transition'
            : 'flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 cursor-pointer transition';
        
        div.onclick = () => navigateToFolder(folder.path);
        
        div.innerHTML = `
            <div class="flex items-center ${viewMode === 'grid' ? 'flex-col text-center' : ''}">
                <svg class="w-12 h-12 text-toms-green ${viewMode === 'grid' ? 'mb-2' : 'mr-4'}" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M2 6a2 2 0 012-2h5l2 2h5a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"></path>
                </svg>
                <div class="${viewMode === 'grid' ? '' : 'flex-1'}">
                    <div class="font-medium text-gray-900">${folder.name}</div>
                    <div class="text-sm text-gray-500">Folder</div>
                </div>
                <div class="flex items-center space-x-2 ${viewMode === 'grid' ? 'mt-2' : ''}">
                    <button onclick="event.stopPropagation(); deleteItem('${folder.path}', 'folder')" class="p-1 text-red-600 hover:bg-red-50 rounded transition" title="Delete">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        
        return div;
    }

    function createFileElement(file, path) {
        const div = document.createElement('div');
        div.className = viewMode === 'grid'
            ? 'inline-block w-48 m-2 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition'
            : 'flex items-center p-4 border-b border-gray-200 hover:bg-gray-50 transition';
        
        const fileIcon = getFileIcon(file.type);
        
        div.innerHTML = `
            <div class="flex items-center ${viewMode === 'grid' ? 'flex-col text-center' : 'flex-1'}">
                ${fileIcon}
                <div class="${viewMode === 'grid' ? 'mt-2' : 'ml-4 flex-1'}">
                    <div class="font-medium text-gray-900">${file.name}</div>
                    <div class="text-sm text-gray-500">${file.size}</div>
                </div>
                <div class="flex items-center space-x-2 ${viewMode === 'grid' ? 'mt-2' : ''}">
                    <button onclick="downloadFile('${file.name}', '${path}')" class="p-1 text-toms-green hover:bg-green-50 rounded transition" title="Download">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                        </svg>
                    </button>
                    <button onclick="deleteItem('${file.name}', 'file', '${path}')" class="p-1 text-red-600 hover:bg-red-50 rounded transition" title="Delete">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        `;
        
        return div;
    }

    function getFileIcon(type) {
        const iconClass = viewMode === 'grid' ? 'w-12 h-12 mb-2' : 'w-10 h-10';
        const color = 'text-blue-600';
        
        if (type === 'pdf') {
            return `<svg class="${iconClass} ${color}" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
            </svg>`;
        }
        
        return `<svg class="${iconClass} ${color}" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd"></path>
        </svg>`;
    }

    function navigateToFolder(path) {
        currentPath = path;
        loadFolder(path);
    }

    function updateBreadcrumb(path) {
        const breadcrumb = document.getElementById('breadcrumbPath');
        if (!path) {
            breadcrumb.innerHTML = '';
            return;
        }
        
        const parts = path.split('/');
        let html = '';
        let currentPath = '';
        
        parts.forEach((part, index) => {
            currentPath += (currentPath ? '/' : '') + part;
            html += `<span class="text-gray-400">/</span>`;
            html += `<button onclick="navigateToFolder('${currentPath}')" class="text-toms-green hover:underline">${part}</button>`;
        });
        
        breadcrumb.innerHTML = html;
    }

    function showCreateFolderModal() {
        document.getElementById('createFolderModal').classList.remove('hidden');
        document.getElementById('folderName').focus();
    }

    function closeCreateFolderModal() {
        document.getElementById('createFolderModal').classList.add('hidden');
        document.getElementById('folderName').value = '';
    }

    function createFolder() {
        const folderName = document.getElementById('folderName').value.trim();
        if (!folderName) {
            alert('Please enter a folder name');
            return;
        }
        
        const newPath = currentPath ? `${currentPath}/${folderName.toLowerCase().replace(/\s+/g, '-')}` : folderName.toLowerCase().replace(/\s+/g, '-');
        
        if (!fileSystem[currentPath]) {
            fileSystem[currentPath] = { folders: [], files: [] };
        }
        
        fileSystem[currentPath].folders.push({
            name: folderName,
            path: newPath
        });
        
        fileSystem[newPath] = { folders: [], files: [] };
        
        closeCreateFolderModal();
        loadFolder(currentPath);
    }

    function handleFileUpload(event) {
        const files = event.target.files;
        if (!files.length) return;
        
        Array.from(files).forEach(file => {
            const fileSize = (file.size / (1024 * 1024)).toFixed(2) + ' MB';
            const fileType = file.name.split('.').pop().toLowerCase();
            
            if (!fileSystem[currentPath]) {
                fileSystem[currentPath] = { folders: [], files: [] };
            }
            
            fileSystem[currentPath].files.push({
                name: file.name,
                size: fileSize,
                type: fileType,
                file: file // Store file object for download
            });
        });
        
        loadFolder(currentPath);
        event.target.value = ''; // Reset input
    }

    function downloadFile(fileName, path) {
        const folder = fileSystem[path] || fileSystem[currentPath];
        const file = folder.files.find(f => f.name === fileName);
        
        if (file && file.file) {
            // Create download link
            const url = URL.createObjectURL(file.file);
            const a = document.createElement('a');
            a.href = url;
            a.download = fileName;
            a.click();
            URL.revokeObjectURL(url);
        } else {
            // Mock download for demo
            alert(`Downloading ${fileName}...\n\n(Backend integration needed for actual download)`);
        }
    }

    function deleteItem(name, type, path = null) {
        if (!confirm(`Are you sure you want to delete this ${type}?`)) return;
        
        const targetPath = path !== null ? path : currentPath;
        const folder = fileSystem[targetPath];
        
        if (type === 'folder') {
            // Delete folder
            const folderIndex = folder.folders.findIndex(f => f.path === name);
            if (folderIndex > -1) {
                folder.folders.splice(folderIndex, 1);
                delete fileSystem[name];
            }
        } else {
            // Delete file
            const fileIndex = folder.files.findIndex(f => f.name === name);
            if (fileIndex > -1) {
                folder.files.splice(fileIndex, 1);
            }
        }
        
        loadFolder(currentPath);
    }

    function toggleViewMode() {
        viewMode = viewMode === 'list' ? 'grid' : 'list';
        document.getElementById('gridIcon').classList.toggle('hidden');
        document.getElementById('listIcon').classList.toggle('hidden');
        loadFolder(currentPath);
    }

    // Close modal on outside click
    document.getElementById('createFolderModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCreateFolderModal();
        }
    });

    // Close modal on Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeCreateFolderModal();
        }
    });
</script>

<style>
    #fileManager {
        display: flex;
        flex-wrap: wrap;
    }
    
    #fileManager .grid-view {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
        gap: 1rem;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app1', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\laragon\www\laravel-app\resources\views/site-documentation.blade.php ENDPATH**/ ?>