<div>
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Posts Management</h2>
    </div>

    <div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
        <div class="flex items-center space-x-2">
            <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search posts..."/>
            <button wire:click="$set('isModalOpen', true)" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
                <i class="fas fa-plus"></i> New Post
            </button>
        </div>
    </div>

    @if(session('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
    @endif

    <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Title</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Slug</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Status</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Date</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($posts as $post)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $post->title }}</td>
                    <td class="px-4 py-3">{{ $post->slug }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded {{ $post->published ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ $post->published ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $post->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        <button wire:click="edit({{ $post->id }})" class="text-indigo-600 hover:text-indigo-800 mr-2">
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <button wire:click="delete({{ $post->id }})" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $posts->links() }}
    </div>

    @if($isModalOpen)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-2xl p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">{{ $post ? 'Edit' : 'Create' }} Post</h3>
                    <button wire:click="resetForm" class="text-gray-500 hover:text-gray-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form wire:submit="save">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Title</label>
                        <input type="text" wire:model="title" class="w-full border rounded px-3 py-2"/>
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Slug</label>
                        <input type="text" wire:model="slug" class="w-full border rounded px-3 py-2"/>
                        @error('slug') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Content</label>
                        <textarea wire:model="content" rows="6" class="w-full border rounded px-3 py-2"></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4 flex items-center gap-4">
                        <label class="flex items-center gap-2">
                            <input type="checkbox" wire:model="published" class="rounded"/>
                            <span class="text-sm">Published</span>
                        </label>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Featured Image</label>
                        <input type="file" wire:model="photo" class="text-sm"/>
                        @error('photo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" wire:click="resetForm" class="px-4 py-2 border rounded hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
