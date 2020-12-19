<x-app-layout>
  <x-slot name="header">
    <h2 class="font-bold text-xl text-blue-800 leading-tight">
        {{ __('Detalle de Solicitud de Compra') }}
    </h2>
  </x-slot>

  <div class="container h-auto mx-auto mt-4">
    <div class="row">
      <div class="col-4">
          <a class="btn btn-danger" href="{{route('compras.solicitudCompras')}}" role="button">Atras</a>
      </div>   
     
      <div class="col-sm-4 overflow-hidden shadow-md sm:rounded-lg bg-white p-2">  
        <h3 class="text-center">Solicitud de Compra Nº: {{$solicitud}}</h3>
        <br>
        <h5 class="text-grey-500">Estado: {{$estado}}</h5>
        <h5 class="text-grey-500">Creada por: {{$usuario}}</h5>
        <h5 class="text-grey-500">Fecha de creación: {{$fecha}}</h5>
      </div> 
    </div> 
  </div>
  
  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-4 p-3 bg-white">
    @if($estado=='Pendiente')
          <div class="d-flex justify-content-center"> 
            <a class="btn btn-primary" href="{{route('compras.solicitudCompra.editar',$solicitud)}}" role="button">Editar Detalles</a>
          </div>
    @endif
        
    <table id="example" class="table table-hover table-bordered" style="width:100%">
          <thead>         
              <tr class="bg-blue-50">
                <th class="text-center w-4">ID</th>  
                <th class="w-40">Descripcion</th>
                <th class="text-center w-12">Cantidad</th>
                <th class="text-center w-32">Fecha de Reposición</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($detalle as $d)   
              <tr>
                <td class="text-center">{{$d->ArticuloID}}</td>
                <td>{{$d->Descripcion}}</td>
                <td class="text-center">{{$d->Cantidad}}</td>
                <td class="text-center">{{$d->FechaResposicionEstimada}}</td>
              </tr>                                           
            @endforeach                            
          </tbody>         
        </table>                      
  </div>    

</x-app-layout>

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
