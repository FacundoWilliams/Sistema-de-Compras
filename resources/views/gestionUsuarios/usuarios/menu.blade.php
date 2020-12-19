<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Administración de Usuarios') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">
        <div class="row">  
            <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
            </div>    
            <div class="col-4"> 
              <a href="{{route('usuario.alta')}}" class="btn btn-primary">Alta de Usuario</a>
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
                        <th class="text-center" style="width:25%">Nombre</th>                      
                        <th class="text-center" style="width:25%">Email</th>
                        <th class="text-center" style="width:20%">Acciones</th>      
                        <th class="text-center" style="width:20%">Roles</th>                                                                          
                    </tr>
                </thead>
                <tbody>                    
                @foreach ($usuarios as $u)          
                    <tr>                
                        <td class="text-center">{{$u->id}}</td>                                                
                        <td class="text-center">{{$u->name}}</td>
                        <td class="text-center">{{$u->email}}</td>
                        <td class="text-center">
                            <!-- Boton trigger modal editar -->
                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalEditar"
                            data-id={{$u->id}}
                            data-nombre="{{$u->name}}"
                            data-email="{{$u->email}}"
                            data-email="{{$u->email}}">
                            
                                Editar
                            </button>
                            <!-- Boton trigger modal eliminar -->
                            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalEliminar"
                            data-id={{$u->id}}
                            data-nombre="{{$u->name}}">
                                Eliminar
                            </button>
                            <td class="text-center">
                              <a class="btn btn-outline-info btn-sm" href="{{route('usuario.verAsignarRol',$u->id)}}" role="button">Asignar</a>
                              <a class="btn btn-outline-danger btn-sm" href="{{route('usuario.verDesasignarRol',$u->id)}}" role="button">Desasignar</a>
                            </td>
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
          <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Usuario</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('usuario.eliminar')}} method="POST">
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
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Usuario</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('usuario.editar')}} method="POST">
        @csrf 
        @method('put')
        <div class="modal-body">                            
          <div class="form-group row">        
              <div class="col">       
                <label for="#name">Nombre</label>              
                <input class="form-control" type="text" id="name" name="name" pattern="[a-zA-Z0-9]+" maxlength="20" required>             
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
          <button type="submit" class="btn btn-primary">Editar</button>
        </div>
      </form>
      </div>
    </div>
  </div>


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
        var nombre = $(e.relatedTarget).data('nombre');    
        var email = $(e.relatedTarget).data('email');    
        $(e.currentTarget).find('#id').val(id);
        $(".modal-body h5").text(nombre);
    });
</script>

<!--Script del modal editar -->
<script> 
    $('#modalEditar').on('show.bs.modal', function(e) {    
        var id = $(e.relatedTarget).data('id');  
        var nombre = $(e.relatedTarget).data('nombre');  
        var email = $(e.relatedTarget).data('email');  
        $(e.currentTarget).find('#id').val(id);
        $(e.currentTarget).find('#name').val(nombre);    
        $(e.currentTarget).find('#email').val(email);    
    });
</script>
