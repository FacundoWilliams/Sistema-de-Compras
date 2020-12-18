<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Administración de Sectores') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">
        <div class="row">  
            <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
            </div>    
            <div class="col-4"> 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta">Alta de Sector</button>
            </div> 
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
                        <th class="text-center" style="width:1%">ID</th>      
                        <th class="text-center" style="width:55%">Descripción de Sector</th>                      
                        <th class="text-center" style="width:15%">Acciones</th>                    
                    </tr>
                </thead>
                <tbody>                    
                @foreach ($sectores as $s)          
                    <tr>                
                        <td class="text-center">{{$s->SectorID}}</td>                                                
                        <td class="text-center">{{$s->Descripcion}}</td>
                        <td class="text-center">
                            <!-- Boton trigger modal editar -->
                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalEditar"
                            data-id={{$s->SectorID}}
                            data-descripcion="{{$s->Descripcion}}"
                            data-persona="{{$s->Persona_a_cargo}}">
                                Editar
                            </button>
                            <!-- Boton trigger modal eliminar -->
                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalEliminar"
                            data-id={{$s->SectorID}}
                            data-descripcion="{{$s->Descripcion}}">
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

<!-- Modal alta -->
<div class="modal fade" id="modalAlta" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Alta de Sector</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('sector.registro')}}" method="POST">
        <!-- Se agrega @csrf para que se genere un token oculto para este form -->
        @csrf      
        <div class="modal-body">                
            <div class="form-group row">        
                <div class="col">       
                    <label for="#id">Id</label>              
                    <input class="form-control" type="number" id="id" name="id" min="0" max="99" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#sector">Sector</label>              
                    <input class="form-control" type="text" id="sector" name="sector" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#persona">Legajo de Persona a Cargo</label>              
                    <input class="form-control" type="number" id="persona" name="persona" min="0" required>             
                </div>
            </div>                                   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
          <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </form>
      </div>
    </div>
</div>

<!-- Modal eliminar -->
<div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Sector</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('sector.eliminar')}} method="POST">
          @csrf 
          @method('put')
        <div class="modal-body">
          <input class="form-control" type="hidden" id="id" name="id">   
          <p class="text-center">
            ¿Estás seguro que deseas eliminar el siguiente sector?
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

<!-- Modal editar -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Sector</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('sector.editar')}} method="POST">
        @csrf 
        @method('put')
        <div class="modal-body">                            
            <div class="form-group row">        
                <div class="col">       
                    <label for="#sector">Sector</label>              
                    <input class="form-control" type="text" id="sector" name="sector" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#persona">Legajo de Persona a Cargo</label>              
                    <input class="form-control" type="number" id="persona" name="persona" required>             
                </div>
            </div>                                   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </form>
      </div>
    </div>
  </div>

@livewireStyles

<style type="text/css">
#persona, #id {
    width: 8em;
}
</style>
  
@livewireScripts

<!--Script del datatable-->
<script>
  $(document).ready(function (){
    var table = $('#example').DataTable({  
        "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        'columnDefs': [{        
            'searchable':true,
            'orderable':true,
            'width':'2%',
            'className': 'dt-body-center',
            'render': function (data, type, full, meta){
            return '<input type="checkbox">';
            }
        }],     
        'order': [0, 'asc'],        
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

<!--Script del modal editar -->
<script> 
    $('#modalEditar').on('show.bs.modal', function(e) {    
        var id = $(e.relatedTarget).data('id');  
        var descripcion = $(e.relatedTarget).data('descripcion');  
        var persona = $(e.relatedTarget).data('persona');  

        $(e.currentTarget).find('#id').val(id);
        $(e.currentTarget).find('#descripcion').val(descripcion);    
        $(e.currentTarget).find('#persona').val(persona);        
    });
</script>
