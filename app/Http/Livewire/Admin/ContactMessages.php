<?php

namespace App\Http\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContactMessage;

#[Layout('layouts.admin')]
class ContactMessages extends Component
{
    use WithPagination;

    public $search = '';
    public $filterRead = 'all'; // all, read, unread

    public function render()
    {
        try {
        $query = ContactMessage::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%')
                  ->orWhere('subject', 'like', '%' . $this->search . '%');
        }

        if ($this->filterRead === 'read') {
            $query->whereNotNull('read_at');
        } elseif ($this->filterRead === 'unread') {
            $query->whereNull('read_at');
        }

        $messages = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('livewire.admin.contact-messages', ['messages' => $messages]);
        } catch (Exception $e) {
            session()->flash('error', 'Failed to load contact messages. Please try again.');
            return view('livewire.admin.contact-messages', ['messages' => []]);
    }
    }

    public function markAsRead(ContactMessage $message)
    {
        try {
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
            session()->flash('message', 'Message marked as read.');
        }
        } catch (Exception $e) {
            session()->flash('error', 'Failed to mark message as read. Please try again.');
    }
    }

    public function markAsUnread(ContactMessage $message)
    {
        try {
        if ($message->read_at) {
            $message->update(['read_at' => null]);
            session()->flash('message', 'Message marked as unread.');
        }
        } catch (Exception $e) {
            session()->flash('error', 'Failed to mark message as unread. Please try again.');
    }
    }

    public function delete(ContactMessage $message)
    {
        try {
        $message->delete();
        session()->flash('message', 'Message deleted successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete message. Please try again.');
    }
}
}
