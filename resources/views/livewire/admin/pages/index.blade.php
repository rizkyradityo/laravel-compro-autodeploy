@push('styles', '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">')
<div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
    <div class="flex items-center space-x-2">
        <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search pages..."/>
        <button type="button" wire:click="toggleModalCreate" class="bg-indigo-600 text-white px-4 py-2 rounded">+ New Page</button>
    </div>
</div>

@if($message)
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded"><strong>Message:</strong> {{ $message }}</div>
@endif

<table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
    <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-xs font-medium">Title</th>
            <th class="px-4 py-2 text-left text-xs font-medium">Slug</th>
            <th class="px-4 py-2 text-left text-xs font-medium">Type</th>
            <th class="px-4 py-2 text-left text-xs font-medium">Published</th>
            <th class="px-4 py-2 text-left text-xs font-medium">Actions</th>
        </tr>
    </thead>
    <tbody class="divide-y divide-gray-200">
        @foreach($pages as $page)
            <tr>
                <td class="px-4 py-2">{{ $page->title }}</td>
                <td class="px-4 py-2">{{ $page->slug }}</td>
                <td class="px-4 py-2">{{ ucfirst($page->type) }}</td>
                <td class="px-4 py-2">{{ $page->published ? 'Published' : 'Draft' }}</td>
                <td class="px-4 py-2 text-center">
                    <x-window-card title="Edit {{ $page->title }}">
                        <x-slot name="content">
                            <livewire:admin.pagecrud :page="$page" />
                        </x-slot>
                    </x-window-card>
                    <form method="POST" action="{{ route('admin.pages.destroy', $page) }}" class="inline" onsubmit="return confirm('Delete {{ $page->title }}?');">
                        @csrf
                        <x-window-card title="Delete {{ $page->title }}">
                            <x-slot name="content">
                                <button type="submit" class="text-red-600 hover:text-red-800"><i class="fas fa-trash"></i></button>
                            </x-slot>
                        </x-window-card>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal for Create/Edit Page -->
@if($isModalOpen)
    <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-2xl p-6">
            @if($page)
                <div class="flex justify-end mr-2">
                    <button type="button" wire:click="resetEdit" class="text-gray-500 hover:text-gray-700">&times;</button>
                </div>
            @endif
            <h2 class="text-xl font-semibold mb-4">{{ $page ? 'Edit' : 'Create' }} Page</h2>
            <livewire:admin.pagecrud :page="$page" />
        </div>
    </div>
@endif

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('modal', () => ({
            open: false,
            toggleModalCreate() {
                this.open = !this.open;
            },
            resetEdit() {
                this.open = false;
                // reset Livewire component state
                Livewire.call('admin.pagecrud.reset');
            }
        }));
    });
</script>