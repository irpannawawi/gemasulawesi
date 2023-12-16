<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Profil') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-2">
                    <label for="username">Username<sup>*</sup> <small>(Tanpa spasi)</small></label>
                    <input type="text" id="username" name="username" class="form-control" required autocomplete="off" value="{{$user->username}}">
                    <input type="hidden"  name="id"  required  value="{{$user->id}}">
                    <input type="hidden"  name="reff"  required  value="profile">
                </div>
                
                <div class="form-group mb-2">
                    <label for="display_name">Nama Pengguna<sup>*</sup></label>
                    <input type="text" id="display_name" name="display_name" class="form-control" required autocomplete="off" value="{{$user->display_name}}">
                </div>

                
                <div class="form-group mb-2">
                    <label for="email">Email<sup>*</sup></label>
                    <input type="email" id="email" name="email" class="form-control" required autocomplete="off" value="{{$user->email}}">
                </div>

                
                <div class="form-group mb-2">
                    <label for="password">Katasandi</label>
                    <input type="password" id="password" name="password" class="form-control" autocomplete="off">
                </div>
                
                <div class="form-group mb-2">
                    <label for="confirm_password">Konfirmasi Katasandi</label>
                    <input type="password" id="confirm_password" name="confirm_password" class="form-control" autocomplete="off">
                </div>

                <div class="form-group mb-2">
                    <img class="mx-auto" width="70"
                                    src="{{ Storage::url('public/avatars/' . $user->avatar) }}" alt="">
                    <label for="avatar">Avatar</label>
                    <input type="file" id="avatar" name="avatar" class="form-control" autocomplete="off">
                </div>

                <div class="form-group mb-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>

                </div>
            </form>
        </div>
    </div>

</x-app-layout>
