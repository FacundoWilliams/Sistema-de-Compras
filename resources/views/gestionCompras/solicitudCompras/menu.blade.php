<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Solicitudes de Compras') }}
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
    @if (session('error'))
    <div class="alert alert-danger" role="alert">
      <strong>{{ session('error') }}</strong>
      <button type="button" class="close" data-dismiss="alert" alert-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>       
    @endif
    <div class="row justify-content-center">
      <div class="col-md-3"> 
        <a class="btn btn-primary" href="{{route('compras.solicitudCompra.selecArticulos')}}" role="button">Alta de Solicitud de Compra</a>
    </div> 
    </div>
    <table id="example" class="table table-hover table-bordered" style="width:100%">
        <caption style="caption-side: top; text-align: center; font-style: italic;">Listado de Solicitudes de Compras</caption>
          <thead>         
              <tr class="bg-blue-50">           
                  <th class="text-center" style="width:5%">ID</th>                 
                  <th class="text-center" style="width:15%">Fecha de Registro</th>                                 
                  <th class="text-center" style="width:30%">Estado</th>
                  <th class="text-center" style="width:20%">Acciones</th>  
              </tr>
          </thead>
          <tbody> 
          @foreach ($solicitudes as $s)            
              <tr>      
                <form id="frm-detalle" action="{{route('compras.solicitudCompra.detalle')}}" method="POST">
                  @csrf                        
                  <input id="id" name="id" type="hidden" value="{{$s->SolicitudCompraID}}">
                  <td class="text-center" name="id">{{$s->SolicitudCompraID}}</td>
                  <td class="text-center" name="fecha">{{$s->FechaRegistro}}</td>            
                  @if ($s->AdminComprasID==NULL)
                    <td class="text-center text-white">
                      <div class="container bg-red-400  rounded">
                        <strong> Pendiente por el Administrador de Compras</strong>
                      </div>
                    </td>  
                  @else
                    <td class="text-center text-white">
                      <div class="container bg-green-400  rounded">
                        <strong>Procesada por el Administrador de Compras</strong>
                      </div>
                
                    </td>
                  @endif
                  <td class="text-center">                 
                    <!-- Boton trigger modal eliminar -->
                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalEliminar" data-id={{$s->SolicitudCompraID}}>
                      Eliminar
                    </button>     
                    <button type="submit" class="btn btn-outline-dark btn-sm">
                      Ver detalle
                    </button>
                  </td>   
                </form>                   
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
        <h5 class="modal-title" id="exampleModalLongTitle">Eliminar Solicitud de Compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="frm-eliminar" action="{{route('compras.solicitudCompra.eliminar')}}" method="POST">
      @csrf                        
      <div class="modal-body">
        <input class="form-control" type="hidden" id="id" name="id">   
        <p class="text-center">
          ¿Estás seguro que deseas eliminar la Solicitud de Compra?
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
      'order': [0, 'desc'],      
    });  
  });
</script>

<!--Script del modal eliminar -->
<script> 
 $('#modalEliminar').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');    
    $(e.currentTarget).find('#id').val(id);
  });
</script>


