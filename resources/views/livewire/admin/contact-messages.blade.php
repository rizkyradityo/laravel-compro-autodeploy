@push('styles', '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">')
<div>
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-800">Contact Messages</h2>
    </div>

<div class="flex flex-col sm:flex-row sm:gap-4 mb-4">
    <div class="flex items-center space-x-2">
        <input type="text" wire:model="search" class="border rounded px-3 py-2 w-64" placeholder="Search messages..."/>
        <select wire:model="filterRead" class="border rounded px-3 py-2">
            <option value="all">All Messages</option>
            <option value="read">Read</option>
            <option value="unread">Unread</option>
        </select>
    </div>
</div>

@if(session('message'))
    <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">{{ session('message') }}</div>
@endif

@if($messages->count() > 0)
    <div class="space-y-4">
        @foreach($messages as $msg)
            <div class="bg-white rounded-lg shadow {{ !$msg->read_at ? 'border-l-4 border-blue-500' : '' }}">
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="text-sm font-semibold text-gray-800">{{ $msg->name }}</span>
                                <span class="text-sm text-gray-600">({{ $msg->email }})</span>
                                @if(!$msg->read_at)
                                    <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded-full">New</span>
@endif
</div>

                            </div>
                            <h4 class="text-lg font-medium text-gray-900 mb-1">{{ $msg->subject }}</h4>
                            <p class="text-gray-700 whitespace-pre-wrap">{{ $msg->message }}</p>
                            <div class="text-xs text-gray-500 mt-2">{{ $msg->created_at->format('F j, Y \a\t g:i A') }}</div>
                        </div>
                        <div class="flex flex-col gap-2 ml-4">
                            @if($msg->read_at)
                                <button wire:click="markAsUnread({{ $msg->id }})" class="text-sm text-blue-600 hover:text-blue-800" title="Mark as unread">
                                    <i class="fas fa-envelope text-lg"></i>
                                </button>
                            @else
                                <button wire:click="markAsRead({{ $msg->id }})" class="text-sm text-gray-600 hover:text-gray-800" title="Mark as read">
                                    <i class="fas fa-envelope-open text-lg"></i>
                                </button>
                            @endif
                            <button wire:click="delete({{ $msg->id }})" class="text-sm text-red-600 hover:text-red-800" title="Delete" onclick="return confirm('Delete this message?')">
                                <i class="fas fa-trash text-lg"></i>
                            </button>
                        </div>
                    </div>
                    @if($msg->media)
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <p class="text-sm font-medium mb-2">Attachment:</p>
                        <a href="{{ asset($msg->media->file_path) }}" target="_blank" class="text-indigo-600 hover:text-indigo-800">
                            <i class="fas fa-paperclip"></i> {{ $msg->media->original_name }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <div class="mt-6">
        {{ $messages->links() }}
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 text-center text-gray-500">
        <i class="fas fa-inbox text-4xl mb-4"></i>
        <p>{!! $filterRead === 'unread' ? 'No unread messages.' : 'No messages found.' !!}</p>
    </div>
@endif