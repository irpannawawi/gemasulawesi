<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            <i class="fas fa-puzzle-piece nav-icon"></i> {{ __('Menu Footer Setting') }}
        </h2>
    </x-slot>

    <div class="card">
        {{-- <div class="card-header">
            <a class="btn btn-primary btn-xs" href="javascript:;" data-toggle="modal" data-target="#addModal"><i
                    class="fas fa-plus"></i> </i>Tambah menu</a>
        </div> --}}
        <form method="POST" action="{{ route('setting.general.update') }}">
            @csrf
            @method('PUT')
            <div class="card-body" id="listForm" style="min-height: 400px">
                <div class="form-group">
                    <label>Tentang Kami</label>
                    <textarea name="our_about" id="our_about" class="editor form-control">{{ @old('our_about', $our_about->value) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Kode Perilaku Pers</label>
                    <textarea name="code_pers" id="code_pers" class="editor form-control">{{ @old('code_pers', $code_pers->value) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Redaksi</label>
                    <textarea name="redaction" id="redaction" class="editor form-control">{{ @old('redaction', $redaction->value) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Pedoman Media Siber</label>
                    <textarea name="pedoman_cyber" id="pedoman_cyber" class="editor form-control">{{ @old('pedoman_cyber', $pedoman_cyber->value) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Kode Etik</label>
                    <textarea name="code_etik" id="code_etik" class="editor form-control">{{ @old('code_etik', $code_etik->value) }}</textarea>
                </div>
                <div class="form-group">
                    <label>Perlindungan Data Pengguna</label>
                    <textarea name="security_user" id="security_user" class="editor form-control">{{ @old('security_user', $security_user->value) }}</textarea>
                </div>
                <div class="form-group mb-4" style="">
                    <label>Lowongan Kerja</label>
                    <textarea name="job" id="job" class="editor form-control">{{ @old('job', $job->value) }}</textarea>
                </div>
                @if ($extras->count()>0)
                <div class="form-group">
                    <h3>Menu Tambahan</h3>
                </div>
                @endif
                @foreach ($extras as $extra)
                    @php
                        $extra_key = $extra->key;
                        $extra_label = Str::replace('-', ' ', explode('--', $extra->key)[1]);
                        $extra_label = Str::ucfirst($extra_label);
                    @endphp
                    <div class="form-group border p-4">
                        <label for="{{$extra->key}}">{{$extra_label}} <small><a href="" class="delete-btn text-danger">Hapus</a></small></label>
                        <textarea name="{{ $extra_key }}" id="{{ $extra_key }}" class="editor form-control">{{ @old($extra_key, $extra->value) }}</textarea>
                    </div>
                @endforeach
                <div class="form-group">
                    <button role="button" type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalAddMenu">+ Tambah menu</button>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary bg-secondary" type="submit" name="action" value="updatefooter">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>


    {{-- Modal add menu --}}
    <div class="modal fade" id="modalAddMenu" tabindex="-1" role="dialog" aria-labelledby="modalAddMenuLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalAddMenuLabel">Tambah data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('setting.addMenu') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="key">Nama Menu</label>
                            <input type="text" name="key" id="key" class="form-control" required
                            autocomplete="off" id="key">
                        </div>
                        <div class="form-group mb-2">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" id="modalAddMenuButton" class="btn btn-primary">Simpan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- ./Modal add menu --}}
    @push('custom-scripts')
        <script src="{{ url('/') }}/build/public/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: '.editor',
                skin: 'oxide',
                // =========== autosave tinymce ====================

                autosave_interval: '10s', // Ubah interval sesuai kebutuhan Anda
                autosave_restore_when_empty: true,
                autosave_ask_before_unload: false,
                autosave_retention: 'localStorage', // Opsional, defaultnya adalah 'localStorage'

                // =========== ./autosave tinymce ====================

                promotion: false,
                fullscreen_native: true,
                height: 500,
                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough |  align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                content_style: 'body{font-family:Helvetica,Arial, sans-serif; font-seize:16px}'
            });
        </script>
    @endpush
</x-app-layout>
