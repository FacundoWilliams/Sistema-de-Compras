<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestión de Permisos') }}
        </h2>
    </x-slot>
    
    <div class="container-lg mx-auto mt-2">
      <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
      </div> 
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
                        <th class="text-center" style="width:30%">Descripción</th>
                        <th class="text-center" style="width:20%">Path Autorizado</th> 
                        <th class="text-center" style="width:5%">Acciones</th> 
                    </tr>
                </thead>
                <tbody>
                @foreach ($permisos as $p)
                    <tr>                
                        <td class="text-center">{{$p->PermisoID}}</td>                        
                        <td>{{$p->Descripcion}}</td>
                        <td>{{$p->PathAuth}}</td>
                        <td class="text-center">                        
                          <!-- Boton trigger modal eliminar -->
                          <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" 
                          data-id={{$p->PermisoID}}
                          data-descripcion="{{$p->Descripcion}}" 
                          >
                              Eliminar
                          </button>
                        </td>
                    </tr>                                                                           
                @endforeach                  
                </tbody>         
            </table>                      
        </div>   
    </div>

</x-app-layout>

<!-- Modal eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar artículo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action={{route('permiso.eliminar')}} method="POST">
        @csrf 
        @method('put')
      <div class="modal-body">
        <input class="form-control" type="hidden" id="id" name="id">   
        <p class="text-center">
          ¿Estás seguro que deseas eliminar el siguiente permiso?
        </p>
        <h5 class="text-center"></h5>       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary">Eliminar</button>
      </div>
      </form>
    </div>
  </div>
</div>


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

<!--Script del modal eliminar -->
<script> 
  $('#modalEliminar').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var descripcion = $(e.relatedTarget).data('descripcion');    
    $(e.currentTarget).find('#id').val(id);
    $(".modal-body h5").text(descripcion);
  });
</script>