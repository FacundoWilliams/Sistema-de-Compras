<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-xl text-blue-800 leading-tight">
        {{ __('Permisos Asignados a ') }} {{$rolid}}
    </h2>
  </x-slot>

  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-4 p-3 bg-white">  
    <div class="col-4">
      <a class="btn btn-danger" href="{{route('rol.menu')}}" role="button">Atras</a>
    </div>
    
    <table id="example" class="table table-hover table-bordered" style="width:100%">
          <thead>         
              <tr class="bg-blue-50">  
                  <th class="text-center" style="width:10%">Permiso ID</th>
                  <th class="text-center" style="width:20%">Descripción</th>
                  <th class="text-center" style="width:10%">Fecha de Creación</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($permisos as $p) 
              <tr>
                  <td>{{$p->PermisoID}}</td>
                  <td>{{$p->Descripcion}}</td>
                  <td>{{$p->created_at}}</td>
              </tr>                                
            @endforeach                  
          </tbody>         
        </table>                      
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
