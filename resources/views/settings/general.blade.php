<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            <i class="fas fa-spell-check nav-icon"></i> {{ __('General Setting') }}
        </h2>
    </x-slot>

    <div class="card">
        <form method="POST" action="{{ route('setting.general.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body" style="min-height: 400px">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Judul Website</label>
                                    <input type="text" maxlength="120" name="title" id="title"
                                        class="form-control" value="{{ @old('title', $title->value) }}">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Sub Judul Website</label>
                                    <input type="text" maxlength="120" name="sub_title" id="sub_title"
                                        class="form-control" value="{{ @old('sub_title', $sub_title->value) }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea name="alamat" id="alamat" class="editor form-control" rows="3">{{ @old('alamat', $alamat->value) }}</textarea>
                        </div>
                        <div class="form-group">
                            <label>Meta Deskripsi</label>
                            <textarea name="meta_google" id="meta_google" class="editor form-control" rows="7">{{ @old('meta_google', $meta_google->value) }}</textarea>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Jumlah Rubrik</label>
                                    <input type="number"name="count_rubrik" id="count_rubrik" class="form-control"
                                        value="{{ @old('count_rubrik', $count_rubrik->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Nomor HP</label>
                                    <input type="number"name="no_hp" id="no_hp" class="form-control"
                                        value="{{ @old('no_hp', $no_hp->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text"name="facebook" id="facebook" class="form-control"
                                        value="{{ @old('facebook', $facebook->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Instagram</label>
                                    <input type="text"name="instagram" id="instagram" class="form-control"
                                        value="{{ @old('instagram', $instagram->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Favicon Website</label>
                                    <img src="{{ @Storage::url('favicon/') }}" class="img-thumbnail mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="favicon" name="favicon">
                                        <label class="custom-file-label" for="favicon">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Youtube</label>
                                    <input type="text"name="youtube" id="youtube" class="form-control"
                                        value="{{ @old('youtube', $youtube->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>X</label>
                                    <input type="text"name="x" id="x" class="form-control"
                                        value="{{ @old('x', $x->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email"name="email" id="email" class="form-control"
                                        value="{{ @old('email', $email->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>No Sertifikat</label>
                                    <input type="text"name="no_sertification" id="no_sertification"
                                        class="form-control"
                                        value="{{ @old('no_sertification', $no_sertification->value) }}">
                                </div>
                                <div class="form-group">
                                    <label>Logo Website</label>
                                    <img src="{{ @Storage::url('logo/' . $logo_web->value) }}"
                                        class="img-thumbnail mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="form-control" id="logo_web" name="logo_web">
                                        <label class="custom-file-label" for="logo_web">Pilih file</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button class="btn btn-secondary bg-secondary" type="submit" name="action" value="updategeneral">
                    <i class="fa fa-save"></i> Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
