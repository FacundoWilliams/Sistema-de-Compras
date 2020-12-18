<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestion de Usuarios') }}
        </h2>
    </x-slot>
        

    <div class="container-lg mx-auto mt-20">
        
        <div class="row">  
            
            <div class="col-4">
                 <!--Admnistración de Usuarios Cards-->                    
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-3 mb-5" src="/img/usuario.png" alt="Administración de Usuarios" >
                    <div class="text-center px-6 py-4">
                        <a href="{{route('usuario.menu') }}" class="btn btn-dark">Administración de Usuarios</a>            
                    </div>
                </div>
            </div>    
            
            <div class="col-4"> 
                <!--Admnistración de Personas Cards-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                    <img class="rounded mx-auto d-block pt-4 mb-5" src="/img/persona.png" alt="Administración de Personas">
                    <div class="text-center px-6 py-4">
                        <a href="{{ route('personas.menu') }}" class="btn btn-dark">Administración de Personas</a>
                    </div>                      
                </div>
            </div> 

            <div class="col-4">                 
                <!--Admnistración de Sectores Cards-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                    <img class="rounded mx-auto d-block pt-3 mb-5" src="/img/sectores.png" alt="Administración de Sectores">
                    <div class="text-center px-6 py-4">
                        <a href="{{ route('sector.menu') }}" class="btn btn-dark">Administración de Sectores</a>
                    </div>                    
                </div>
            </div>
    
        </div> 
        
        <div class="row mt-5 offset-2">

            <div class="col-4"> 
                <!--Admnistración de Roles Cards-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                    <img class="rounded mx-auto d-block mb-15 mt-10" src="/img/rol.png" alt="Administración de Roles">
                    <div class="text-center px-4 py-2 mt-4">
                        <a href="{{ route('rol.menu') }}" class="btn btn-dark" >Administración de Roles</a>
                    </div>                  
                </div> 
            </div> 

            <div class="col-4">                 
                <!--Admnistración de Permisos Cards-->
                <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                    <img class="rounded mx-auto d-block mt-4 mb-15" src="/img/permisos.png" alt="Administración de Permisos">
                    <div class="text-center px-4 mt-4">
                        <a href="{{ route('permiso.menu') }}" class="btn btn-dark" >Administración de Permisos</a>                     
                    </div>
                </div>
            </div>
            
        </div> 

</x-app-layout>