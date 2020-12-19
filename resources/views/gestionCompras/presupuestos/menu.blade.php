<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Administración de Presupuestos') }}
  </h2>
</x-slot>
<div class="container h-auto mx-auto mt-2">
  <div class="row">  
    <div class="col-4">
      <a class="btn btn-danger" href="{{route('gestionCompras')}}" role="button">Atras</a>
    </div>    
  </div> 
  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">     
      <table id="example" class="table table-hover table-bordered" style="width:100%">
        <caption style="caption-side: top; text-align: center; font-style: italic;">Listado de Solicitudes de Compras</caption>
          <thead>         
              <tr class="bg-blue-50">           
                  <th class="text-center" style="width:5%">ID</th>                 
                  <th class="text-center" style="width:15%">Fecha de Registro</th>                                 
                  <th class="text-center" style="width:30%">Estado</th>  
                  <th class="text-center" style="width:20%">Presupuestos</th>              
              </tr>
          </thead>
          <tbody> 
          @foreach ($solicitudes as $s)            
              <tr>                             
                  <input id="id" name="id" type="hidden" value="{{$s->SolicitudCompraID}}">
                  <td class="text-center" name="id">{{$s->SolicitudCompraID}}</td>
                  <td class="text-center" name="fecha">{{$s->FechaRegistro}}</td>            
                    @if ($s->AdminComprasID==NULL)
                      <td class="text-center text-white">
                        <div class="container bg-red-400  rounded">
                          <strong> No existen Solicitudes de Presupuestos</strong>
                        </div>
                      </td>  
                    @else
                        <td class="text-center text-white" name="estado">
                          <div class="container bg-green-400  rounded">
                            <strong>Existen Solicitudes de Presupuestos</strong>
                          </div>
                        </td>
                    @endif
                  <td class="text-center">                 
                    <a href="{{route('compras.presupuestos.registrados', $s->SolicitudCompraID)}}" class="btn btn-outline-info btn-sm">Registrados</a>
                    <a href="{{route('compras.presupuestos.solicitudes', $s->SolicitudCompraID)}}" class="btn btn-outline-dark btn-sm">Solicitados</a>    
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
      'order': [0, 'desc'],  
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
