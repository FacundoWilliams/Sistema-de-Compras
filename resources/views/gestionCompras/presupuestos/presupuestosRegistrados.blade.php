<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Presupuestos Registrados') }}
  </h2>
</x-slot>
<div class="container h-auto mx-auto mt-2">
  <div class="row">
      <div class="col-4">
        <a class="btn btn-danger" href="{{route('compras.presupuestos')}}" role="button">Atras</a>
      </div>     
      <div class="col-sm-5 overflow-hidden shadow-md sm:rounded-lg bg-white p-2">  
        <h3 class="text-center">Solicitud de Compra Nº: {{$solCompra[0]->SolicitudCompraID}}</h3>
        <br>
        <h5 class="text-grey-500">Estado: {{$solCompra[0]->EstadoID}}</h5>
        <h5 class="text-grey-500">Fecha de creación: {{$solCompra[0]->FechaHora}}</h5>
        <h5 class="text-grey-500">Creada por: {{$solCompra[0]->name}}</h5>
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
      <table id="example" class="table table-hover table-bordered" style="width:100%">
        <caption style="caption-side: top; text-align: center; font-style: italic;">Listado de Presupuestos Registrados</caption>
          <thead>         
              <tr class="bg-blue-50">        
                  <th class="text-center" style="width:8%">ID</th>                 
                  <th class="text-center" style="width:25%">Proveedor</th>                                 
                  <th class="text-center" style="width:25%">Estado</th>  
                  <th class="text-center" style="width:18%">Acciones</th>  
              </tr>
          </thead>
          <tbody>         
          @foreach ($presu_regi as $p)            
              <tr>                             
                  <td class="text-center" name="idsp">{{$p->PresupuestoID}}</td>
                  <td class="text-center" name="proveedor">{{$p->Razon_social}}</td>
                  <td class="text-center" name="proveedor">

                  </td>
                  <td class="text-center">  
                    <a href="{{route('compras.presupuestosRegistrados.seleccionPresuRegistrado',$p->PresupuestoID)}}" class="btn btn-outline-success btn-sm">Seleccionar</a>  
                    <a href="{{route('compras.presupuestosRegistrados.verDetalle',$p->PresupuestoID)}}" class="btn btn-outline-danger btn-sm">Ver detalle</a>                      
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


