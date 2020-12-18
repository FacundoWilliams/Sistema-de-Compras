<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Alta de Usuario') }}
        </h2>
    </x-slot>
    
    <div class="container-md mt-2">
        <div class="row">  
            <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
            </div>
        </div>
    </div>
    
    <div class="w-1/3 h-auto sm:rounded-md mx-auto mt-5 bg-blue-100 shadow-xl">
        <div class="  bg-blue-50 overflow-hidden shadow-xl sm:rounded-lg px-10 py-5">  
        <x-jet-validation-errors class="mb-4" />
            
        <form method="POST" action="{{ route('usuario.registro') }}">
            @csrf
            <div class="form-group row">        
                <div class="col">       
                    <label for="#name">Nombre</label>              
                    <input class="form-control" type="text" id="name" name="name" pattern="[a-zA-Z]+" maxlength="20" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">
                    <label for="#email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" required>  
                </div>
            </div> 
            <div class="form-group row">
                <div class="col">  
                <label for="#password">Password</label>
                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                </div>
            </div>      
            <div class="form-group row">
                <div class="col">
                    <label for="#password_confirmation">Confirme Password</label>
                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="#legajo">Legajo</label>
                    <input id="legajo" class="form-control" type="number" name="legajo" min="0" max="100" required>
                </div>
            </div>
            <div class="flex items-center justify-end py-4">
                <x-jet-button class="block mt-1 w-full">
                    {{ __('Registrar') }}
                </x-jet-button>
            </div>
        </div>
    </div>
</x-app-layout>

@livewireStyles

<style type="text/css">
#legajo{
    width: 8em;
}
</style>
  