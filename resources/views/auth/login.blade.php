<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <img src="/img/logo_guest.png" alt="logo">
            <!--<x-jet-authentication-card-logo />-->
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="name" value="{{ __('Usuario') }}" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                @if (Route::has('password.request'))
                <div class="mb-4">
                    {{--<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Recuperar password') }}
                    </a>--}}
                @endif
                </div>
                <label for="remember_me" class="flex items-center">
                    <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Recordarme') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                
            
                {{--<a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Registro</a>--}}
                
            
                <x-jet-button class="block mt-1 w-full">
                    {{ __('Login') }}
                </x-jet-button>
                
            </div>

        </form>
    </x-jet-authentication-card>
</x-guest-layout>
