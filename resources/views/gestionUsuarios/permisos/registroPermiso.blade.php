<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Alta de Permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div>
        </div>
    </div>
    <!-- Formulario de Alta-->
    <div class="container">
        <form action="{{route('permiso.store')}}" method="POST">
            <!-- Se agrega @csrf para que se genere un token oculto para este form -->
            @csrf 
            <label>
                IDPermiso
                <input type="text" name="permisoID">
            </label>
            <label>
                Descripción
            </label>
            <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
            <label>
                Permiso
                <select name="permiso" id="per" required>
                    <option value="/solicitudesCompras/Alta"> Alta Solicitud Compra</option>
                    <option value="/solicitudesCompras/Baja"> Baja Solicitud Compra</option>
                    <option value="/solicitudesCompras/Modificacion"> Modificacion Solicitud Compra</option>
                    <option value="/solicitudesCompras/Consulta"> Consulta Solicitud Compra</option>
                </select>
            </label>
            <button type="submit">Resgitrar Permiso</button>
        </form>
</x-app-layout>
