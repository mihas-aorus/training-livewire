<div wire:ignore.self class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-plus mr-1"></i>Tambah {{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <label for="nama" class="form-label">Nama</label>
            <span class="text-danger">*</span>
            <input wire:model="nama"
                type="text"
                class="form-control
                    @error('nama')
                    is-invalid
                    @enderror
                    "
                placeholder="Masukkan Nama">
            @error('nama')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="email" class="form-label">Email</label>
            <span class="text-danger">*</span>
            <input wire:model="email"
                type="email"
                class="form-control
                    @error('email')
                    is-invalid
                    @enderror
                    "
                placeholder="Masukkan Email">
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="role" class="form-label">Role</label>
            <span class="text-danger">*</span>
            <select id="role"
                wire:model="role"
                class="form-control
                    @error('role')
                    is-invalid
                    @enderror
                    ">
                <option selected>--Pilih Role--</option>
                <option value="superadmin">Super Admin</option>
                <option value="admin">Admin</option>
                <option value="user">User</option>
            </select>
            @error('role')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="password" class="form-label">Kata Laluan</label>
            <span class="text-danger">*</span>
            <input wire:model="password"
                type="password"
                class="form-control
                    @error('password')
                    is-invalid
                    @enderror
                    "
                placeholder="Masukkan Kata Laluan">
            @error('password')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="row mb-3">
            <label for="password_confirmation" class="form-label">Pengesahan Kata Laluan</label>
            <span class="text-danger">*</span>
            <input wire:model="password_confirmation"
                type="password"
                class="form-control
                    @error('password_confirmation')
                    is-invalid
                    @enderror
                    "
                placeholder="Masukkan Pengesahan Kata Laluan">
            @error('password_confirmation')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Batal</button>
        <button wire:click="store" type="button" class="btn btn-primary btn-sm"><i class="fas fa-save mr-1"></i>Simpan</button>
      </div>
    </div>
  </div>
</div>
