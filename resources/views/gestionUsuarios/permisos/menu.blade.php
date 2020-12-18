<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestión de Permisos') }}
        </h2>
    </x-slot>
    <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
            </div> 
    <div class="container-lg mx-auto mt-2">
        <div class="d-flex justify-content-center"> 
          <a class="btn btn-primary" href="{{route('permiso.registro')}}" role="button">Alta de Permiso</a>
        </div>      
        <div class="container-lg sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">
          @if (session('success'))
            <div class="alert alert-success" role="success">
              <strong>{{ session('success') }}</strong>
              <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>       
          @endif
          @if (session('error'))
            <div class="alert alert-danger" role="alert">
              <strong>{{ session('error') }}</strong>
              <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif  
            <table id="example" class="table table-hover table-bordered" style="width:100%">
                <thead>         
                    <tr class="bg-blue-50">           
                        <th class="text-center" style="width:5%">Permiso ID</th>
                        <th class="text-center" style="width:10%">Descripción</th>
                        <th class="text-center" style="width:10%">Path Autorizado</th> 
                        <th class="text-center" style="width:10%">Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                @foreach ($permisos as $p)
                    <tr>                
                        <td class="text-center">{{$p->PermisoID}}</td>                        
                        <td>{{$p->Descripcion}}</td>
                        <td>{{$p->PathAuth}}</td>
                        <td class="text-center"  >
                            <a href="{{route('rol.verQuitarPermisos', $p->PermisoID)}}" class="btn btn-outline-danger btn-sm">Eliminar </a>
                            <a href="{{route('rol.verPermisos', $p->PermisoID)}}" class="btn btn-outline-dark btn-sm">Editar </a>
                        </td>
        
                    </tr>                                                                           
                @endforeach                  
                </tbody>         
            </table>                      
        </div>   
    </div>

</x-app-layout>

@livewireScripts

       


<script>

  $(document).ready(function (){

    var table = $('#example').DataTable({  
      
      "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
      }

    });
  });
</script>
