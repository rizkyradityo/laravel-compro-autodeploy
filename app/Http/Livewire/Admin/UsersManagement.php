<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class UsersManagement extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        try {
        $query = User::query();

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('email', 'like', '%' . $this->search . '%');
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('livewire.admin.users', ['users' => $users]);
        } catch (Exception $e) {
            session()->flash('error', 'Failed to load users. Please try again.');
            return view('livewire.admin.users', ['users' => []]);
    }
    }

    public function deleteUser(User $user)
    {
        try {
        if ($user->id === auth()->id()) {
            session()->flash('error', 'You cannot delete your own account.');
            return;
        }

        $user->delete();
        session()->flash('message', 'User deleted successfully.');
        } catch (Exception $e) {
            session()->flash('error', 'Failed to delete user. Please try again.');
    }
}
}
