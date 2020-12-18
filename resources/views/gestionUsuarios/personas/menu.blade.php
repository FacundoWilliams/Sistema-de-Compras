<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Administración de Personas') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">        
        <div class="row">  
            <div class="col-5">
              <a class="btn btn-danger" href="{{route('gestionUsuarios')}}" role="button">Atras</a>
            </div>    
            <div class="col-4"> 
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta">Alta de Persona</button>
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
                        <th class="text-center" style="width:1%">Legajo</th>      
                        <th class="text-center" style="width:20%">Nombre</th>                      
                        <th class="text-center" style="width:20%">Apellido</th>                        
                        <th class="text-center" style="width:30%">Email</th>                    
                        <th class="text-center" style="width:15%">Acciones</th>                    
                    </tr>
                </thead>
                <tbody>                    
                @foreach ($personas as $p)                 
                    <tr>                
                        <td class="text-center">{{$p->Legajo}}</td>                                                
                        <td class="text-center">{{$p->Nombre}}</td>
                        <td class="text-center">{{$p->Apellido}}</td> 
                        <td class="text-center">{{$p->Mail}}</td> 
                        <td class="text-center">
                            <!-- Boton trigger modal editar -->
                            <button type="button" class="btn btn-outline-info btn-sm px-3" data-toggle="modal" data-target="#modalEditar"
                            data-legajo={{$p->Legajo}}
                            data-nombre="{{$p->Nombre}}"
                            data-apellido="{{$p->Apellido}}"
                            data-telefono="{{$p->telefono}}"
                            data-mail="{{$p->Mail}}"
                            data-dni="{{$p->DNI}}"
                            data-cuil="{{$p->Cuil}}"
                            data-direccion="{{$p->Direccion}}">
                                Editar
                            </button>
                            <!-- Boton trigger modal eliminar -->
                            <button type="button" class="btn btn-outline-danger btn-sm px-2" data-toggle="modal" data-target="#modalEliminar"
                            data-legajo={{$p->Legajo}}
                            data-nombre="{{$p->Nombre}}"
                            data-apellido="{{$p->Apellido}}">
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
          <h5 class="modal-title" id="exampleModalLongTitle">Alta de Persona</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('persona.registro')}}" method="POST">
        <!-- Se agrega @csrf para que se genere un token oculto para este form -->
        @csrf      
        <div class="modal-body"> 
            <div class="form-group row">        
                <div class="col">       
                    <label for="#legajo">Legajo</label>              
                    <input class="form-control" type="number" id="legajo" name="legajo" min="0" max="100" required>             
                </div>
            </div>               
            <div class="form-group row">        
                <div class="col">       
                    <label for="#nombre">Nombre</label>              
                    <input class="form-control" type="text" id="nombre" name="nombre" pattern="[a-zA-Z ]+" maxlength="30" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#apellido">Apellido</label>              
                    <input class="form-control" type="text" id="apellido" name="apellido" pattern="[a-zA-Z ]+" maxlength="30" required>             
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="#dni">DNI</label>
                    <input class="form-control" type="text" id="dni" name="dni" pattern="[a-zA-Z0-9]+" maxlength="8" required>              
                </div>                   
                <div class="col">
                    <label for="#cuil">CUIL</label>
                    <input class="form-control" type="text" id="cuil" name="cuil" pattern="[0-9]+" maxlength="13" required>              
                </div>              
            </div>      
            <div class="form-group row">     
                <div class="col">
                    <label for="#mail">Email</label>
                    <input class="form-control" type="email" id="mail" name="mail" required>  
                </div>           
                <div class="col">
                    <label for="#telefono">Telefono</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]+" maxlength="20" required>  
                </div>                        
            </div>            
            <div class="form-group row"> 
                <div class="col">
                    <label for="#direccion">Direccion</label>
                    <input class="form-control" type="text" id="dir" name="dir" maxlength="50" required>  
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
          <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Persona</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('persona.eliminar')}} method="POST">
          @csrf 
          @method('put')
        <div class="modal-body">
            <input class="form-control" type="hidden" id="legajo" name="legajo">                                                  
          <p class="text-center">
            ¿Estás seguro que deseas eliminar la siguiente persona?
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
          <h5 class="modal-title" id="exampleModalLongTitle">Editar Persona</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('persona.editar')}} method="POST">
        @csrf 
        @method('put')
        <div class="modal-body">    
            <input class="form-control" type="hidden" id="legajo" name="legajo">                                                  
            <div class="form-group row">        
                <div class="col">       
                    <label for="#nombre">Nombre</label>              
                    <input class="form-control" type="text" id="nombre" name="nombre" pattern="[a-zA-Z ]+" maxlength="8" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#apellido">Apellido</label>              
                    <input class="form-control" type="text" id="apellido" name="apellido" pattern="[a-zA-Z ]+" maxlength="30" required>             
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="#dni">DNI</label>
                    <input class="form-control" type="text" id="dni" name="dni" pattern="[a-zA-Z0-9]+" maxlength="8" required>              
                </div>                   
                <div class="col">
                    <label for="#cuil">CUIL</label>
                    <input class="form-control" type="text" id="cuil" name="cuil" pattern="[0-9]+" maxlength="13" required>              
                </div>              
            </div>      
            <div class="form-group row">     
                <div class="col">
                    <label for="#mail">Email</label>
                    <input class="form-control" type="email" id="mail" name="mail" required>  
                </div>           
                <div class="col">
                    <label for="#telefono">Telefono</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]+" maxlength="20" required>  
                </div>                        
            </div>            
            <div class="form-group row"> 
                <div class="col">
                    <label for="#direccion">Direccion</label>
                    <input class="form-control" type="text" id="dir" name="dir" maxlength="50" required>  
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
#legajo {
    width: 6em;
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
        var legajo = $(e.relatedTarget).data('legajo');
        var nombre = $(e.relatedTarget).data('nombre');  
        var apellido = $(e.relatedTarget).data('apellido'); 
        var persona = nombre + " " + apellido;
        $(e.currentTarget).find('#legajo').val(legajo);
        $(".modal-body h5").text(persona);
    });
</script>

<!--Script del modal editar -->
<script> 
    $('#modalEditar').on('show.bs.modal', function(e) {    
        var legajo = $(e.relatedTarget).data('legajo');
        var nombre = $(e.relatedTarget).data('nombre');  
        var apellido = $(e.relatedTarget).data('apellido'); 
        var dni = $(e.relatedTarget).data('dni');  
        var cuil = $(e.relatedTarget).data('cuil');  
        var mail =  $(e.relatedTarget).data('mail');
        var telefono =  $(e.relatedTarget).data('telefono'); 
        var direccion =  $(e.relatedTarget).data('direccion'); 

        $(e.currentTarget).find('#legajo').val(legajo);
        $(e.currentTarget).find('#nombre').val(nombre);
        $(e.currentTarget).find('#apellido').val(apellido);
        $(e.currentTarget).find('#dni').val(dni);
        $(e.currentTarget).find('#cuil').val(cuil);
        $(e.currentTarget).find('#mail').val(mail);
        $(e.currentTarget).find('#telefono').val(telefono);
        $(e.currentTarget).find('#dir').val(direccion);
    });
</script>
