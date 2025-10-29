<?php

namespace App\Livewire\Superadmin\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';

    public $nama, $email, $role, $password, $password_confirmation, $user_id;
    public function render()
    {
        $data = array(
            'title' => 'Data User',
            'user' => User::where('nama', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orderBy('role', 'asc')->paginate($this->paginate),
        );

        return view('livewire.superadmin.user.index', $data);
    }

    public function create()
    {
        $this->resetValidation();

        $this->reset([
            'nama', 'email', 'role', 'password', 'password_confirmation',
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama'                      => 'required',
            'email'                     => 'required|email|unique:users,email',
            'role'                      => 'required',
            'password'                  => 'required|min:8|confirmed',
        ],
    [
        'nama.required'                     => 'Nama wajib diisi.',
        'email.required'                    => 'Email wajib diisi.',
        'email.email'                       => 'Email tidak sah.',
        'email.unique'                      => 'Email sudah terdaftar.',
        'role.required'                     => 'Role wajib diisi.',
        'password.required'                 => 'Kata Laluan wajib diisi.',
        'password.min'                      => 'Kata Laluan tidak boleh kurang daripada 8 aksara.',
        'password.confirmed'                => 'Pengesahan Kata Laluan tidak sepadan.',
        ]);

        $user = new User;
        $user->nama                     = $this->nama;
        $user->email                    = $this->email;
        $user->role                     = $this->role;
        $user->password                 = Hash::make($this->password);
        $user->save();

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->resetValidation();

        $user = User::findOrFail($id);
        $this->nama                     = $user->nama;
        $this->email                    = $user->email;
        $this->role                     = $user->role;
        $this->password                 = '';
        $this->password_confirmation    = '';
        $this->user_id                  = $user->id;
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $this->validate([
            'nama'                      => 'required',
            'email'                     => 'required|email|unique:users,email,'.$id,
            'role'                      => 'required',
            'password'                  => 'nullable|min:8|confirmed',
        ],
    [
        'nama.required'                     => 'Nama wajib diisi.',
        'email.required'                    => 'Email wajib diisi.',
        'email.email'                       => 'Email tidak sah.',
        'email.unique'                      => 'Email sudah terdaftar.',
        'role.required'                     => 'Role wajib diisi.',
        'password.required'                 => 'Kata Laluan wajib diisi.',
        'password.min'                      => 'Kata Laluan tidak boleh kurang daripada 8 aksara.',
        'password.confirmed'                => 'Pengesahan Kata Laluan tidak sepadan.',
        ]);

        $user->nama                     = $this->nama;
        $user->email                    = $this->email;
        $user->role                     = $this->role;
        if ($this->password) {
            $user->password             = Hash::make($this->password);
        }

        $user->save();

        $this->dispatch('closeEditModal');
    }
}
