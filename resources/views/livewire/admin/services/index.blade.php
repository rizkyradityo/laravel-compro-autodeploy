@push('styles', '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">')
<div>
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Services Management</h2>
    </div>

    <div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
        <div class="flex items-center space-x-2">
            <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search services..."/>
            <button wire:click.prevent="toggleModal" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                <i class="fas fa-plus"></i> New Service
            </button>
        </div>
    </div>

    @if(session('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
    @endif

    <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Slug</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Description</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($services as $service)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $service->name }}</td>
                    <td class="px-4 py-3">{{ $service->slug }}</td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ Str::limit($service->description, 100) }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded {{ $service->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $service->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-4 py-3">
                        <button wire:click="edit({{ $service->id }})" class="text-indigo-600 hover:text-indigo-800 mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button wire:click="delete({{ $service->id }})" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $services->links() }}
    </div>

    @if($isModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">{{ $service ? 'Edit' : 'Create' }} Service</h3>
                    <button wire:click="toggleModal" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form wire:submit.prevent="save">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Name</label>
                        <input type="text" wire:model="name" class="w-full border rounded px-3 py-2"/>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Slug</label>
                        <input type="text" wire:model="slug" class="w-full border rounded px-3 py-2"/>
                        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea wire:model="description" rows="4" class="w-full border rounded px-3 py-2"></textarea>
                        @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 flex items-center gap-6">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="published" class="rounded"/>
                            <span class="text-sm">Published</span>
                        </label>
                        <label class="block text-sm font-medium">Photo</label>
                        @if($service->media_id)
                            <img src="{{ asset($service->media->file_path) }}" class="h-16 w-auto"/>
                            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        @else
                            <input type="file" wire:model="photo" class="text-sm"/>
                            @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        @endif
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Meta Title</label>
                        <input type="text" wire:model="meta_title" class="w-full border rounded px-3 py-2"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Meta Description</label>
                        <input type="text" wire:model="meta_description" class="w-full border rounded px-3 py-2"/>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="toggleModal" class="px-4 py-2 border rounded hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>