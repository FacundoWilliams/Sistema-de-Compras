<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Alta de Usuario') }}
        </h2>
    </x-slot>
    <div class="w-1/3 h-auto sm:rounded-md mx-auto mt-20 bg-blue-100 shadow-xl">
        <div class="  bg-blue-50 overflow-hidden shadow-xl sm:rounded-lg px-10 py-5">
          
            <x-jet-validation-errors class="mb-4" />
            
            <form method="POST" action="{{ route('usuario.store') }}">
                @csrf
                <div class="mt-4">
                    <x-jet-label for="name" value="{{ __('Usuario') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>
    
                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirme Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="legajo" value="{{ __('Legajo') }}" />
                    <x-jet-input id="legajo" class="block mt-1 w-full" type="number" name="legajo" required />
                </div>

                {{--
                <div class="mt-4">
                    <x-jet-label for="Legajo" value="{{ __('Legajo') }}" />
                    <x-jet-input id="Legajo" class="block mt-1 w-full" type="numeric" name="Legajo" />
                </div>
                --}}
                
                <div class="flex items-center justify-end py-4">
                    <x-jet-button class="block mt-1 w-full">
                        {{ __('Registrar') }}
                    </x-jet-button>
                </div>
              
        </div>
    </div>
</x-app-layout>
