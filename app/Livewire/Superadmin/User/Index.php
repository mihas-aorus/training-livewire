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

    public $nama, $email, $role, $password, $password_confirmation;
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
}
