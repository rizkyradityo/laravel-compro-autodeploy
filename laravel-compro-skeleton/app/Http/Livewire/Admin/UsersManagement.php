<?php

namespace App\Http\Livewire\Admin;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

#[Layout('layouts.admin')]
class UsersManagement extends Component
{
    use WithPagination;

    public $search = '';

    public $editingUser = null;
    public $editName = '';
    public $editEmail = '';
    public $editRole = '';

    protected function rules(): array
    {
        return [
            'editName' => ['required', 'string', 'max:255'],
            'editEmail' => ['required', 'email', 'max:255', 'unique:users,email,' . $this->editingUser],
            'editRole' => ['required', 'in:user,admin'],
        ];
    }

    public function edit(int $id): void
    {
        $user = User::findOrFail($id);
        $this->editingUser = $user->id;
        $this->editName = $user->name;
        $this->editEmail = $user->email;
        $this->editRole = $user->role ?? 'user';
    }

    public function cancelEdit(): void
    {
        $this->reset(['editingUser', 'editName', 'editEmail', 'editRole']);
    }

    public function update(): void
    {
        $this->validate();

        try {
            $user = User::findOrFail($this->editingUser);
            $user->update([
                'name' => $this->editName,
                'email' => $this->editEmail,
                'role' => $this->editRole,
            ]);

            session()->flash('message', 'User updated successfully.');
            $this->cancelEdit();
        } catch (Exception $e) {
            session()->flash('error', 'Failed to update user.');
        }
    }

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
