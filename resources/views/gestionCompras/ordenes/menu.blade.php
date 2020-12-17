<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Administración de Ordenes de Compras') }}
  </h2>
</x-slot>
<div class="container h-auto mx-auto mt-2">
  <div class="row">  
    <div class="col-4">
      <a class="btn btn-danger" href="{{route('gestionCompras')}}" role="button">Atras</a>
    </div>    
  </div> 
  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">     
  @if (session('success'))
    <div class="alert alert-success" role="success">
      <strong>{{ session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" alert-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>       
  @endif
      <table id="example" class="table table-hover table-bordered" style="width:100%">
        <caption style="caption-side: top; text-align: center; font-style: italic;">Listado de Ordenes de Compras</caption>
          <thead>         
              <tr class="bg-blue-50">           
                  <th class="text-center" style="width:5%">ID</th>                 
                  <th class="text-center" style="width:15%">Fecha de Registro</th>                                 
                  <th class="text-center" style="width:25%">Proveedor</th>  
                  <th class="text-center" style="width:35%">Estado</th>             
                  <th class="text-center" style="width:20%">Acciones</th>               
              </tr>
          </thead>
          <tbody> 
          @foreach ($ordenes as $o)            
              <tr>                             
                <td class="text-center">{{$o->OrdenCompraID}}</td>
                <td class="text-center">{{$o->FechaRegistro}}</td>
                <td class="text-center">{{$o->Razon_social}}</td>
                @if ($o->IDAprobador == NULL)
                <td class="text-center text-white">
                  <div class="container bg-yellow-400  rounded">
                    <strong>Orden de Compra sin evaluación</strong>
                  </div>
                </td>                
                @else
                <td class="text-center text-white">
                  <div class="container bg-green-400  rounded">
                    <strong>Orden de Compra evaluada</strong>
                  </div>
                </td>   
                @endif                                    
                <td class="text-center">                  
                  <a href="{{route('compras.ordenes.verDetalle', $o->OrdenCompraID)}}" class="btn btn-outline-dark btn-sm">Ver detalle</a>    
                </td>                                                               
              </tr>                                                     
          @endforeach                           
        </tbody>         
      </table>                    
  </div>   
</div>
</x-app-layout>


<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

@livewireScripts


<!--Script del datatable-->
<script>
  $(document).ready(function (){ 
    var table = $('#example').DataTable({  
      "language": {
      "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
      },      
    });  
  });
</script>

<!--Script del modal eliminar -->
<script> 
 $('#modalEliminar').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('descripcion');    
    $(e.currentTarget).find('#id').val(id);
  });
</script>

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
      <form action={{route('gestionArticulos.eliminar')}} method="POST">
        @csrf 
        @method('put')
      <div class="modal-body">
        <input class="form-control" type="hidden" id="id" name="id">   
        <p class="text-center">
          ¿Estás seguro que deseas eliminar el siguiente artículo?
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