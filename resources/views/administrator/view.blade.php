<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('User Management') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#addUserModal"><i
                    class="fa fa-plus"></i>Tambah data</button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-sm">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Avatar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @php
                        $n = 1;
                    @endphp
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $n++ }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->display_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role }}</td>
                            <td><img src="{{ Storage::url('public/avatars/'.$user->avatar) }}" alt=""></td>
                            <td>
                                <button class="btn btn-info" data-target="#edituserModal" data-toggle="modal" onclick="edit_user('{{$user->id}}','{{$user->username}}')">Edit</button>
                                <a class="btn btn-danger" onclick="return confirm('Hapus user?')"
                                    href="{{ route('users.delete', ['id' => $user->id]) }}">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    {{-- Modals add user --}}

    <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.add') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-2">
                            <label for="username">Username<sup>*</sup> <small>(Tanpa spasi)</small></label>
                            <input type="text" id="username" name="username" class="form-control" required autocomplete="off">
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="display_name">Nama Pengguna<sup>*</sup></label>
                            <input type="text" id="display_name" name="display_name" class="form-control" required autocomplete="off">
                        </div>

                        
                        <div class="form-group mb-2">
                            <label for="email">Email<sup>*</sup></label>
                            <input type="email" id="email" name="email" class="form-control" required autocomplete="off">
                        </div>

                        
                        <div class="form-group mb-2">
                            <label for="password">Katasandi<sup>*</sup></label>
                            <input type="password" id="password" name="password" class="form-control" required autocomplete="off">
                        </div>
                        
                        <div class="form-group mb-2">
                            <label for="confirm_password">Konfirmasi Katasandi<sup>*</sup></label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required autocomplete="off">
                        </div>
                        <div class="form-group mb-2">
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="" selected disabled>--Pilih Role--</option>
                                <option value="admin">Admin</option>
                                <option value="editor">Editor</option>
                                <option value="author">Author</option>
                            </select>
                        </div>

                        <div class="form-group mb-2">
                            <label for="avatar">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="form-control" required autocomplete="off">
                        </div>

                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal edit user --}}
    <div class="modal fade" id="edituserModal" tabindex="-1" role="dialog" aria-labelledby="edituserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edituserModalLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.edit') }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label for="user">Nama user</label>
                            <input type="text" name="user_name" class="form-control" required autocomplete="off" id="input-user-name">
                            <input type="hidden" name="id" class="form-control" required autocomplete="off" id="input-user-id">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('custom-scripts')
        <script>
            function edit_user(id, name) {
                $('#input-user-name').val(name)
                $('#input-user-id').val(id)
            }
        </script>
    @endpush
</x-app-layout>
