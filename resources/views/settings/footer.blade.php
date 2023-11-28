<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800   leading-tight">
            {{ __('General Setting') }}
        </h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('setting.general.update') }}">
            @csrf
            @method('PUT')
            <div class="card-body" style="min-height: 400px">
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
                <div class="form-group">
                    <label>Lowongan Kerja</label>
                    <textarea name="job" id="job" class="editor form-control">{{ @old('job', $job->value) }}</textarea>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary bg-secondary" type="submit" name="action" value="updatefooter">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
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
