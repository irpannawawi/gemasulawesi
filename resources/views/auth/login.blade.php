<x-guest-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function getToken(token) {
            $('#g-token').val(token)
        }

        function do_login() {
            data = {
                gtoken: $('#g-token').val(),
                email: $('#email').val(),
                password: $('#password').val(),
                remember_me: $('#remember_me').val(),
                _token: '{{ csrf_token() }}'
            }
            console.log('logingin')
            $.post('{{ route('login') }}', data, (res) => {
                console.log(res)
                if (res.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: 'Authentikasi berhasil',
                    }).then(()=>{

                        window.location.href = '/dashboard';
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: res.message,
                    })
                }

            }).fail((res) => {
                console.log(res.responseJSON)
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: res.responseJSON.message,
                })
            });
        }
    </script>
    <script async src="https://www.google.com/recaptcha/api.js"></script>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        <h3 class="text-center">Login</h3>
        @csrf

        <!-- Email Address -->
        <div>
            <input type="hidden" name="g-token" id="g-token" />
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <!-- Password -->
        <div class="mt-2">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="g-recaptcha mt-3" data-callback="getToken" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3" type="button" onclick="do_login()" id="submitButton">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
