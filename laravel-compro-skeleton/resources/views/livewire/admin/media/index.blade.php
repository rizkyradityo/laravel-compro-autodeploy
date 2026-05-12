@push('styles', '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">')
<div>
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Media Manager</h2>
    </div>

<div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
    <div class="flex items-center space-x-2">
        <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search media..."/>
    </div>
</div>

@if(session('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
@endif

<!-- Upload Section -->
<div class="bg-white rounded-lg shadow p-6 mb-6">
    <h3 class="text-lg font-semibold mb-4">Upload Media</h3>
    <form wire:submit.prevent="save">
        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
            <input type="file" wire:model="uploads" class="text-sm" multiple accept="image/*"/>
            <p class="text-gray-600 text-sm mt-2">Click to upload images (Max 2MB each)</p>
            @error('uploads.*') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
        </div>
        <div class="mt-4">
            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                <i class="fas fa-upload"></i> Upload
            </button>
        </div>
    </form>
</div>

<!-- Media Grid -->
<div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
    @foreach($media as $item)
        <div class="bg-white rounded-lg shadow overflow-hidden group">
            <div class="relative">
                <img src="{{ asset($item->file_path) }}" class="w-full h-32 object-cover"/>
                <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center space-x-2">
                    <button wire:click="delete({{ $item->id }})" class="bg-red-500 text-white p-2 rounded hover:bg-red-600" onclick="return confirm('Delete this image?')">
                        <i class="fas fa-trash"></i>
                    </button>
                    <button onclick="copyToClipboard('{{ asset($item->file_path) }}')" class="bg-white text-gray-800 p-2 rounded hover:bg-gray-100">
                        <i class="fas fa-link"></i>
                    </button>
                </div>
            </div>
            <div class="p-2">
                <p class="text-xs text-gray-700 truncate" title="{{ $item->original_name }}">{{ $item->original_name }}</p>
                <p class="text-xs text-gray-500">{{ $item->mime_type }}</p>
            </div>
        </div>
    @endforeach
</div>

{{ $media->links() }}

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(function() {
            alert('Copied to clipboard!');
        });
    }
</script>
</div>
