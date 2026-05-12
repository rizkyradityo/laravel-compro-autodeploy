<div>
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Users Management</h2>
    </div>

    <div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
        <div class="flex items-center space-x-2">
            <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search users..."/>
        </div>
    </div>

    @if(session('message'))
        <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">{{ session('error') }}</div>
    @endif

    <table class="w-full bg-white border border-gray-200 rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-100">
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Name</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Email</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Role</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Joined</th>
                <th class="px-4 py-3 text-left text-xs font-medium text-gray-600 uppercase">Actions</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
            @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">
                        <span class="px-2 py-1 text-xs rounded {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                            {{ ucfirst($user->role ?? 'user') }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="px-4 py-3">
                        @if($user->id !== auth()->id())
                            <button wire:click="edit({{ $user->id }})" class="text-indigo-600 hover:text-indigo-800 mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <button wire:click="deleteUser({{ $user->id }})" class="text-red-600 hover:text-red-800" onclick="return confirm('Delete this user?')">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        @else
                            <span class="text-gray-400 text-sm">Current user</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>

    @if($editingUser)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Edit User</h3>
                    <button wire:click="cancelEdit" class="text-gray-400 hover:text-gray-600">&times;</button>
                </div>
                <form wire:submit="update">
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                        <input type="text" wire:model="editName" class="border rounded px-3 py-2 w-full"/>
                        @error('editName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" wire:model="editEmail" class="border rounded px-3 py-2 w-full"/>
                        @error('editEmail') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
                        <select wire:model="editRole" class="border rounded px-3 py-2 w-full">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                        @error('editRole') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" wire:click="cancelEdit" class="px-4 py-2 border rounded text-gray-700 hover:bg-gray-50">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Save</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
