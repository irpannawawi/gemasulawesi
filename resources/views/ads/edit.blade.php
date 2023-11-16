<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800   leading-tight">
            {{ __('Ads Management - Create') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Ads</h3>
        </div>
        <div class="card-body">
            <div class="col-md-6 mx-auto">
                <form method="POST" enctype="multipart/form-data" action="{{ route('ads.update', ['ad' => $ad->ads_id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-2">
                        <label for="type">Pilih Jenis</label>
                        <select name="type" id="select-jenis" class="form-control">
                            <option value="---" disabled>---</option>
                            <option value="img" {{ $ad->type == 'img' ? 'selected' : '' }}>Image</option>
                            <option value="html" {{ $ad->type == 'html' ? 'selected' : '' }}>Html Tag / scripts</option>
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="formTitle">Title <sup>*</sup></label>
                        <input type="text" name="title" id="formTitle" value="{{ $ad->title }}"
                            class="form-control" required>
                    </div>

                    <div class="form-group mb-2" id="formGambar" style="display: none;">
                        <label for="formImage">Pilih Gambar</label>
                        <input type="file" name="image" id="formImage" class="form-control">
                    </div>

                    <div class="form-group mb-2" id="formScript" style="display: none;">
                        <label for="formImage">Isi script</label>
                        <textarea name="script" id="script" class="form-control" rows="10">{{ $ad->type == 'html' ? $ad->value : '' }}</textarea>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="submit" class="btn btn-primary form-control">
                    </div>
                </form>
            </div>
        </div>
    </div>


    @push('custom-scripts')
        <script>
            var select_jenis = $('#select-jenis')
            var gambar = $('#formGambar')
            var script_tag = $('#formScript')
            
            script_tag_input = $('#script')
            gambar_input = $('#formImage')

            if (select_jenis.val() == 'img') {
                gambar.show()
                script_tag.hide()
            } else {
                gambar.hide()
                script_tag.show()
            }

            select_jenis.on('change', () => {
                script_tag_input = $('#script')
                gambar_input = $('#formImage')
                if (select_jenis.val() == 'img') {
                    gambar_input.val('')
                    script_tag_input.val('')
                    gambar.show()
                    script_tag.hide()
                } else {
                    gambar.hide()
                    script_tag.show()
                    gambar_input.val('')
                    script_tag_input.val('')
                }
            })
        </script>
    @endpush
</x-app-layout>
