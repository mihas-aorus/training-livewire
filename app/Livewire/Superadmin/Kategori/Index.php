<?php

namespace App\Livewire\Superadmin\Kategori;

use App\Models\Kategori;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $paginate = '10';
    public $search = '';

    public $nama_kategori, $kategori_id;
    public function render()
    {
        $data = array(
            'title' => 'Data Kategori',
            'kategori' => Kategori::where('nama_kategori', 'like', '%'.$this->search.'%')
            ->orderBy('nama_kategori', 'asc')->paginate($this->paginate),
        );

        return view('livewire.superadmin.kategori.index', $data);
    }

    public function create()
    {
        $this->resetValidation();

        $this->reset([
            'nama_kategori',
        ]);
    }

    public function store()
    {
        $this->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ],
    [
        'nama_kategori.required' => 'Nama Kategori wajib diisi.',
        'nama_kategori.unique' => 'Nama Kategori telah wujud.',
        ]);

        $kategori = new Kategori;
        $kategori->nama_kategori = $this->nama_kategori;
        $kategori->save();

        $this->dispatch('closeCreateModal');
    }

    public function edit($id)
    {
        $this->resetValidation();

        $kategori = Kategori::findOrFail($id);
        $this->nama_kategori    = $kategori->nama_kategori;
        $this->kategori_id      = $kategori->id;
    }

    public function update($id)
    {
        $kategori = Kategori::findOrFail($id);

        $this->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,'.$id,
        ],
    [
        'nama_kategori.required' => 'Nama Kategori wajib diisi.',
        'nama_kategori.unique' => 'Nama Kategori telah wujud.',
        ]);

        $kategori->nama_kategori = $this->nama_kategori;

        $kategori->save();

        $this->dispatch('closeEditModal');
    }

    public function confirm($id)
    {
        $kategori = Kategori::findOrFail($id);
        $this->nama_kategori = $kategori->nama_kategori;

        $this->kategori_id = $kategori->id;
    }

    public function destroy($id)
    {
        Kategori::findOrFail($id)->delete();

        $this->dispatch('closeDeleteModal');
    }
}
