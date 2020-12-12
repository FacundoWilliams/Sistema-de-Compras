<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestion de Usuarios') }}
        </h2>
    </x-slot>
        
        <div class="flex flex-wrap bg-gray-100 ml-64 mr-64 mt-20">

            <div class="w-1/3 p-4 bg-gray-100">                
                <div class="text-gray-700 text-center bg-gray-100 p-4">
                    <!--Admnistración de Usuarios Cards-->                    
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                        <img class="rounded mx-auto d-block mb-5" src="/img/usuario.png" alt="Administración de Usuarios" >
                        <div class="px-6 py-4">
                            <a href="{{ route('usuario.consulta') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Usuarios</a>            
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-1/3 p-4">
                <div class="text-gray-700 text-center bg-gray-100 p-4">
                    <!--Admnistración de Personas Cards-->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                        <img class="rounded mx-auto d-block pt-4 mb-5" src="/img/persona.png" alt="Administración de Personas">
                        <div class="px-6 py-4">
                            <!--<a href="{{ route('persona.registro') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Personas</a>-->
                            <a href="{{ route('personas.menu') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Personas</a>
                        </div>                      
                    </div>
                </div>
            </div>

            <div class="w-1/3 p-4">
                <div class="text-gray-700 text-center bg-gray-100 p-4">
                    <!--Admnistración de Sectores Cards-->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                        <img class="rounded mx-auto d-block pt-4 mb-5" src="/img/sectores.png" alt="Administración de Sectores">
                        <div class="px-6 py-4">
                            {{--<a href="{{ route('sector.registro') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Sectores</a>--}}
                            <a href="{{ route('sector.menu') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Sectores</a>
                        </div>                    
                    </div>
                </div>
            </div>    

            <div class="w-1/3 ml-48">
                <div class="text-gray-700 text-center bg-gray-100 p-4">
                    <!--Admnistración de Roles Cards-->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                        <img class="rounded mx-auto d-block mb-10 mt-10" src="/img/rol.png" alt="Administración de Roles">
                        <div class="px-4 py-2 mt-4">
                            <a href="{{ route('rol.registro') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Roles</a>
                        </div>                  
                    </div>                
                </div>
            </div> 

            <div class="w-1/3 ml-32">
                <div class="text-gray-700 text-center bg-gray-100 p-4">
                    <!--Admnistración de Permisos Cards-->
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">
                        <img class="rounded mx-auto d-block mt-5 mb-10" src="/img/permisos.png" alt="Administración de Permisos">
                        <a href="{{ route('permiso.registro') }}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Administración de Permisos</a>                     
                    </div>
                </div>
            </div>

        </div>  
</x-app-layout>