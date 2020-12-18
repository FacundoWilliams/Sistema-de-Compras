    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Usuarios') }}
        </h2>
    </x-slot>

    <div class="container mx-auto py-2 mt-3">
        <div class="flex items-center justify-center mb-3">
            <a href="{{route('usuario.alta')}}" class="btn btn-success bg-blue-500 text-white font-bold px-2 py-1 rounded-lg  hover:bg-blue-700">Alta de Usuario</a>
        </div>
        <div class=" bg-white rounded-lg shadow overflow-hidden mx-auto mb-4">
            <div class="flex bg-white px-4 py-3 border-t border-gray-100 sm:px-6">               
                <input wire:model="search" class="form-input rounded-md shadow-sm block w-full mt-3 mb-3"  type="text" placeholder="Buscar Usuario...">
                <div wire:model="perPage" class="form-input rounded-md shadow-sm mt-3 mb-3 ml-3 block">
                    <select class="outline-none text-gray-500 text-sm">                    
                        <option value="5">5 por página</option>
                        <option value="10">10 por página</option>
                        <option value="15">15 por página</option>
                        <option value="20">20 por página</option>
                    </select>
                </div>
            </div>
           
            @if ($usuarios->count())
                <table class="min-w-full divide-y divide-gray-200">                    
                    <thead class="bg-blue-50 border-b border-gray-200">
                        <tr class="text-xs font-medium text-gray-500 uppercase text-left">
                            <th class="px-20 py-3">ID</th>
                            <th class="px-20 py-3">Usuario</th>
                            <th class="px-20 py-3">Email</th>
                            <th class="px-20 py-3 text-center">Acciones</th>                                                        
                        </tr>
                    </thead>             
                    <tbody class="divide-y divide-gray-200">                           
                        @foreach ($usuarios as $usuario)                                                       
                            @if ( $usuario->Activo == 1 )
                                <tr>
                                    <td class="px-20">
                                        {{$usuario->id}}                                    
                                    </td>
                                    <td class="px-20">
                                        {{$usuario->name}}                                    
                                    </td>
                                    <td class="px-20">
                                        {{$usuario->email}}                                    
                                    </td>                                                                                      
                                    <td class="px-20 py-2">                                   
                                        <div class="flex items-center justify-end">
                                            <button class="bg-green-500 text-white font-bold px-2 py-1 rounded-lg  hover:bg-green-700">Editar</button>                                            
                                            <form action="{{route('usuario.baja',$usuario)}}" id="for-eli" class="for-eli" method="POST">                                          
                                                <button type="submit" class="bg-red-500 text-white font-bold ml-2 px-2 py-1 rounded-lg hover:bg-red-700">Eliminar</button>
                                                @csrf      
                                                {{--LLamada al metodo delete para que ejecute el POST--}}                                      
                                                @method('delete')                                                                                            
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach  
                    </tbody>
                </table>
            @else
                <div class="bg-white px-4 py-3 border-t border-gray-100 sm:px-6">
                    No se encontraron coincidencias
                </div>
            @endif
            <div class="bg-white mt-2 px-4 py-2 border-t border-gray-200">
                {{$usuarios->links()}}
            </div>        
        </div>
   </div>

 

   @livewireScripts

   {{--
    Mensaje que se muestra el eliminar un usuario.
    --}}
   @if (session('eliminar') == 'ok')
       <script>
            Swal.fire(
            'Usuario eliminado',
            '',
            'success'                 
            ) 
       </script>       
   @endif

   {{--
    Script que captura el evento del formulario al hacer click en el botón eliminar y solicita confirmación
    para continuar la elimiación
    --}}
   <script>

        const form = document.getElementById('for-eli');
        form.addEventListener('submit', e =>{

        /*var form = document.getElementsByName('.for-eli');
        form.forEach(item => {*/
            item.addEventListener('submit', event => {
            e.preventDefault();
              
            Swal.fire({
            title: '¿Estás seguro que deseas eliminar un usuario?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirmar',
            cancelButtonText: 'Cancelar'
            }).then((result) => {
            if (result.isConfirmed) {
                /*Swal.fire(
                'Usuario eliminado',
                '',
                'success'                 
                ) */
                form.submit();
            }
            })

        })
    });
    
   </script>

