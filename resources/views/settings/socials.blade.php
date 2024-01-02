@push('extra-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@endpush
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            <i class="fa fa-share-alt nav-icon"></i> {{ __('Auto Share') }}
        </h2>
    </x-slot>

    <div class="card">
        <ul class="nav nav-tabs" id="socialTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="facebook-tab" data-toggle="tab" href="#facebook" role="tab"
                    aria-controls="facebook" aria-selected="true"><i class="fa-brands fa-facebook"></i> Facebook</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="instagram-tab" data-toggle="tab" href="#instagram" role="tab"
                    aria-controls="instagram" aria-selected="false"><i class="fa-brands fa-instagram"></i>
                    Instagram</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="twitter-tab" data-toggle="tab" href="#twitter" role="tab"
                    aria-controls="twitter" aria-selected="false"><i class="fa-brands fa-x-twitter"></i> Twitter</a>
            </li>
        </ul>
        <div class="card-body">
            <div class="tab-content" id="socialTabContent">
                <div class="tab-pane fade show active" id="facebook" role="tabpanel" aria-labelledby="facebook-tab">
                    <!-- Facebook content goes here -->
                    {{-- Cek jika sudah terkoneksi --}}
                    @if (!$fbAuth)
                        <a href="{{ route('socials.facebook.auth') }}" class="btn btn-primary btn-sm"><i
                                class="fa-brands fa-facebook"></i> Connect</a>
                    @else
                        <div class="row">
                            <div class="col-md-5">
                                <b>Facebook Accounts</b>
                                <div class="info-box shadow-none">
                                    <div class="info-box-icon">
                                        <img src="{{ $fbAuth->avatar }}" alt="">
                                    </div>
                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $fbAuth->name }}</span>
                                        <span class="info-box-number">{{ $fbAuth->email }}</span>
                                    </div>
                                </div>
                            </div>

                            @if ($fbPage)
                                <div class="col-md-5">
                                    <b>Facebook Pages</b>
                                    <div class="info-box shadow-none">
                                        <div class="info-box-icon">
                                            <img src="{{ $fbPage->page_avatar }}" alt="">
                                        </div>
                                        <div class="info-box-content">
                                            <span class="info-box-text">{{ $fbPage->name }}</span>
                                            <span class="info-box-number">{{ $fbPage->category }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>


                        <button role="button" data-toggle="modal" data-target="#pageModal" onclick="getPages()"
                            class="btn btn-primary btn-sm"><i class="fa fa-newspaper"></i> Pages</button>
                        <a href="{{ route('socials.facebook.disconnect') }}" class="btn btn-danger btn-sm"><i
                                class="fa-brands fa-facebook"></i> Disconnect</a>
                    @endif
                    {{-- kalau belum tampilkan button login --}}

                </div>
                <div class="tab-pane fade" id="instagram" role="tabpanel" aria-labelledby="instagram-tab">
                    <!-- Instagram content goes here -->
                    @if ($fbPage)
                        <div class="col-md-5">
                            <b>Instagram Account</b>
                            <div class="info-box shadow-none">
                                <div class="info-box-icon">
                                    <img src="{{ $fbPage->instagram_profile_pic }}" alt="">
                                </div>
                                <div class="info-box-content">
                                    <span class="info-box-text">{{ $fbPage->instagram_username }}</span>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="tab-pane fade" id="twitter" role="tabpanel" aria-labelledby="twitter-tab">
                    <!-- Twitter content goes here -->
                    @if (!$XAuth)
                        <a href="{{ route('socials.x.auth') }}" class="btn btn-primary btn-sm"><i
                                class="fa-brands fa-x-twitter"></i> Connect</a>
                    @else
                        @php
                            $x = json_decode($XAuth->user);
                        @endphp
                        <div class="row">
                            <div class="col-md-5">
                                <b>X Accounts</b>
                                <div class="info-box shadow-none">
                                    <div class="info-box-icon">
                                        <img src="{{ $x->profile_image_url }}" alt="">
                                    </div>
                                    <div class="info-box-content">
                                        <span class="info-box-text">{{ $XAuth->name }}</span>
                                        <span class="info-box-number">{{ '@' . $XAuth->nickname }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <a href="{{ route('socials.x.disconnect') }}" class="btn btn-danger btn-sm"><i
                                class="fa-brands fa-x-twitter"></i> Disconnect</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="pageModal" tabindex="-1" role="dialog" aria-labelledby="pageModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="pageModalLabel">Select Page</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="pagesContainer"></div>
                        <div id="loading" class="overlay">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script defer>
            function getPages() {
                // add loading 
                $('#loading').show()
                $.get('{{ route('socials.facebook.addPages') }}', function(data) {
                    $('#pagesContainer').html(data)
                    $('#loading').hide()
                });
            }
        </script>
</x-app-layout>
@push('custom-scripts')
@endpush
