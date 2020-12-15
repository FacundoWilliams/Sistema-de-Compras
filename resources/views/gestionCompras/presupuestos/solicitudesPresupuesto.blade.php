<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Solicitudes de Presupuestos') }}
  </h2>
</x-slot>
<div class="container h-auto mx-auto mt-2">
  <div class="row">
      <div class="col-4">
        <a class="btn btn-danger" href="{{route('compras.presupuestos')}}" role="button">Atras</a>
      </div>     
      <div class="col-sm-4 overflow-hidden shadow-md sm:rounded-lg bg-white p-2">  
        <h3 class="text-center">Solicitud de Compra Nº: {{$solicitud}}</h3>
        <br>
        <h5 class="text-grey-500">Estado: {{$estado}}</h5>
        <h5 class="text-grey-500">Fecha de creación: {{$fecha}}</h5>
        </div> 
    </div> 


  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">      
    @if (session('success'))
    <div class="alert alert-succces" role="alert">
      <strong>{{session('success') }}</strong>
      <button type="button" class="close" data-dismiss="alert" alert-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>       
    @endif
      <div class="d-flex justify-content-center"> 
          <a href="{{route('compras.presupuestos.solicitar',$solicitud)}}" class="btn btn-primary btn-sm mt-2">Solicitar Presupuesto</a>  
      </div>
      <table id="example" class="table table-hover table-bordered" style="width:100%">
        <caption style="caption-side: top; text-align: center; font-style: italic;">Listado de Presupuestos Solicitados</caption>
          <thead>         
              <tr class="bg-blue-50">        
                  <th class="text-center" style="width:5%">ID</th>                 
                  <th class="text-center" style="width:25%">Proveedor</th>                                 
                  <th class="text-center" style="width:30%">Estado</th>  
                  <th class="text-center" style="width:25%">Acciones</th>                    
              </tr>
          </thead>
          <tbody>         
          @foreach ($solpresupuestos as $s)            
              <tr>                             
                  <td class="text-center" name="idsp">{{$s->SolicitudPresupuestoID}}</td>
                  <td class="text-center" name="proveedor">{{$s->Razon_social}}</td>
                    @if($s->PresupuestoID == NULL)
                      <td class="text-center text-white">
                        <div class="container bg-red-400  rounded">
                          <strong>Sin presupuesto registrado</strong>
                        </div>
                      </td>                             
                    @else 
                      <td class="text-center text-white">
                        <div class="container bg-green-400  rounded">
                          <strong>Existe presupuesto registrado</strong>
                        </div>
                      </td>  
                    @endif                        
                  <td class="text-center">  
                    <input type="hidden" name="artID[]" value="{{$solicitud}}">                                            
                    @if($s->PresupuestoID == NULL)
                      <a href="{{route('compras.presupuestos.alta',$s->SolicitudPresupuestoID)}}" class="btn btn-outline-success btn-sm">Registrar Presupuesto</a>  
                    @endif     
                    <a href="{{route('compras.presupuestoSolicitado.verDetalle',$s->SolicitudPresupuestoID)}}" class="btn btn-outline-danger btn-sm">Ver detalle</a>                      
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
