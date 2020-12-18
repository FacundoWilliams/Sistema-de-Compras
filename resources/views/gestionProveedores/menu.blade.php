<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestión de Proveedores') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">
        <div class="d-flex justify-content-center"> 
          <!-- Boton trigger modal alta -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta">Alta de Proveedor</button>
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
                        <th class="text-center" style="width:20%">Razon Social</th>                        
                        <th class="text-center" style="width:20%">Direccion</th>
                        <th class="text-center" style="width:15%">Localidad</th>                                                  
                        <th class="text-center" style="width:15%">Provincia</th> 
                        <th class="text-center" style="width:10%">Telefono</th>  
                        <th class="text-center" style="width:25%">Acciones</th>  
                    </tr>
                </thead>
                <tbody>                    
                @foreach ($proveedores as $p) 
                  @if ( $p->Activo == 1 )
                    <tr>                
                        <td class="text-center">{{$p->ProveedorID}}</td>                                                
                        <td class="text-center">{{$p->Razon_social}}</td>
                        <td class="text-center">{{$p->Direccion}}</td>
                        <td class="text-center">{{$p->Localidad}}</td>                  
                        <td class="text-center">{{$p->Provincia}}</td>
                        <td class="text-center">{{$p->Telefono}}</td>  
                        <td class="text-center">
                        <!-- Boton trigger modal editar -->
                        <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalEditar"                           
                        data-id={{$p->ProveedorID}}
                        data-nombre="{{$p->Nombre}}"
                        data-razon_social="{{$p->Razon_social}}"  
                        data-cuit="{{$p->Cuit}}"                                          
                        data-direccion="{{$p->Direccion}}"
                        data-telefono="{{$p->Telefono}}"
                        data-mail="{{$p->Mail}}"
                        data-localidad="{{$p->Localidad}}"
                        data-provincia="{{$p->Provincia}}"
                        >
                        Editar
                        </button>
                        <!-- Boton trigger modal eliminar -->
                        <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modalEliminar" 
                        data-id={{$p->ProveedorID}}
                        data-razon_social="{{$p->Razon_social}}"
                        >
                            Eliminar
                        </button>
                        </td>                            
                    </tr>                                              
                  @endif                               
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
          <h5 class="modal-title" id="exampleModalLongTitle">Alta de Proveedor</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('gestionProveedores.alta')}}" method="POST">
        <!-- Se agrega @csrf para que se genere un token oculto para este form -->
        @csrf      
        <div class="modal-body">                
            <div class="form-group row">        
                <div class="col">       
                    <label for="#nombre">Nombre</label>              
                    <input class="form-control" type="text" id="nombre" name="nombre" pattern="[a-zA-Z ]+" maxlength="50" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#razon_social">Razón social</label>              
                    <input class="form-control" type="text" id="razon_social" name="razon_social" pattern="[a-zA-Z0-9 ]+" maxlength="50"required>             
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="#cuit">CUIT</label>
                    <input class="form-control" type="text" id="cuit" name="cuit" pattern="[0-9]+" maxlength="11" required>              
                </div>                   
                <div class="col">            
                    <label for="#iva">IVA</label>
                    <select name="iva" class="form-select rounded-md shadow-sm w-36 mt-4" required>
                        <option value="RI">RI</option> 
                        <option value="RNI">RNI</option> 
                        <option value="CF">CF</option>
                        <option value="Exento">Exento</option>                                                        
                        <option value="Monotributo">Monotributo</option>
                    </select>
                </div>                 
            </div>      
            <div class="form-group row">     
                <div class="col">
                    <label for="#direccion">Dirección</label>
                    <input class="form-control" type="text" id="direccion" name="direccion" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>  
                </div> 
            </div>
            <div class="form-group row"> 
                <div class="col-md-4">
                    <label for="#telefono">Telefono</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]+" maxlength="20" required>  
                </div>
                <div class="col">
                    <label for="#mail">E-mail</label>
                    <input class="form-control" type="text" id="mail" name="mail" size="50" required>  
                </div>           
            </div>            
            <div class="form-group row"> 
                <div class="col">
                    <label for="#localidad">Localidad</label>
                    <input class="form-control" type="text" id="localidad" name="localidad" pattern="[a-zA-Z0-9 ]+" maxlength="25" required>  
                </div>            
                <div class="col">
                    <label for="#provincia">Provincia</label>
                    <input class="form-control" type="text" id="provincia" name="provincia" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>  
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
          <h5 class="modal-title" id="exampleModalLongTitle">Eliminar proveedor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('gestionProveedores.eliminar')}} method="POST">
          @csrf 
          @method('put')
        <div class="modal-body">
          <input class="form-control" type="hidden" id="id" name="id">   
          <p class="text-center">
            ¿Estás seguro que deseas eliminar el siguiente proveedor?
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
          <h5 class="modal-title" id="exampleModalLongTitle">Editar proveedor</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('gestionProveedores.editar')}} method="POST">
        @csrf 
        @method('put')
        <div class="modal-body">        
            <div class="form-group row">        
                <div class="col">
                    <input class="form-control" type="hidden" id="id" name="id">                                      
                    <label for="#nombre">Nombre</label>              
                    <input class="form-control" type="text" id="nombre" name="nombre" pattern="[a-zA-Z ]+" maxlength="25" required>             
                </div>
            </div>   
            <div class="form-group row">        
                <div class="col">       
                    <label for="#razon_social">Razón social</label>              
                    <input class="form-control" type="text" id="razon_social" name="razon_social" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>             
                </div>
            </div>
            <div class="form-group row">
                <div class="col">
                    <label for="#cuit">CUIT</label>
                    <input class="form-control" type="text" id="cuit" name="cuit" pattern="[0-9]+" maxlength="11" required>              
                </div>                   
                <div class="col">            
                    <label for="#iva">IVA</label>
                    <select name="iva" class="form-select rounded-md shadow-sm w-36 mt-4" required>
                        <option value="RI">RI</option> 
                        <option value="RNI">RNI</option> 
                        <option value="CF">CF</option>
                        <option value="Exento">Exento</option>                                                        
                        <option value="Monotributo">Monotributo</option>
                    </select>
                </div>                 
            </div>      
            <div class="form-group row">     
                <div class="col">
                    <label for="#direccion">Dirección</label>
                    <input class="form-control" type="text" id="direccion" name="direccion" pattern="[a-zA-Z0-9 ]+" maxlength="50" required>  
                </div> 
            </div>
            <div class="form-group row"> 
                <div class="col-md-4">
                    <label for="#telefono">Telefono</label>
                    <input class="form-control" type="text" id="telefono" name="telefono" pattern="[0-9]+" maxlength="20" required>  
                </div>
                <div class="col">
                    <label for="#mail">E-mail</label>
                    <input class="form-control" type="text" id="mail" name="mail" size="50" required>  
                </div>           
            </div>            
            <div class="form-group row"> 
                <div class="col">
                    <label for="#localidad">Localidad</label>
                    <input class="form-control" type="text" id="localidad" name="localidad" pattern="[a-zA-Z ]+" maxlength="25" required>  
                </div>            
                <div class="col">
                    <label for="#provincia">Provincia</label>
                    <input class="form-control" type="text" id="provincia" name="provincia"  pattern="[a-zA-Z ]+" maxlength="50"required>  
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
#telefono {
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
        var razon_social = $(e.relatedTarget).data('razon_social');    
        $(e.currentTarget).find('#id').val(id);
        $(".modal-body h5").text(razon_social);
    });
</script>

<!--Script del modal editar -->
<script> 
    $('#modalEditar').on('show.bs.modal', function(e) {    
        var id = $(e.relatedTarget).data('id');  
        var nombre = $(e.relatedTarget).data('nombre');  
        var razon_social = $(e.relatedTarget).data('razon_social');  
        var cuit = $(e.relatedTarget).data('cuit');         
        var direccion =  $(e.relatedTarget).data('direccion'); 
        var telefono =  $(e.relatedTarget).data('telefono'); 
        var mail =  $(e.relatedTarget).data('mail'); 
        var localidad =  $(e.relatedTarget).data('localidad'); 
        var provincia =  $(e.relatedTarget).data('provincia'); 
        $(e.currentTarget).find('#id').val(id);
        $(e.currentTarget).find('#nombre').val(nombre);    
        $(e.currentTarget).find('#razon_social').val(razon_social);   
        $(e.currentTarget).find('#cuit').val(cuit);
        $(e.currentTarget).find('#direccion').val(direccion);
        $(e.currentTarget).find('#telefono').val(telefono);
        $(e.currentTarget).find('#mail').val(mail);
        $(e.currentTarget).find('#localidad').val(localidad);
        $(e.currentTarget).find('#provincia').val(provincia);
    });
</script>
