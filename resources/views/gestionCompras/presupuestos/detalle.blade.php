<x-app-layout>
    <x-slot name="header">
      <h2 class="font-bold text-xl text-blue-800 leading-tight">
          {{ __('Detalle de Solicitud de Presupuesto') }}
      </h2>
    </x-slot>
    <div class="container h-auto mx-auto mt-2">
      <div class="row">
          <div class="col-3">
            <a class="btn btn-danger" href="{{route('compras.presupuestos.solicitudes',$solicitud->SolicitudCompraID)}}" role="button">Atras</a>
          </div>     
          <div class="col-sm-6 overflow-hidden shadow-md sm:rounded-lg bg-white p-2">  
                <h3 class="text-center">Solicitud de Presupuesto Nº: {{$sol}}</h3>
                <h5 class="text-center">Creada por: {{$solicitud->name}}</h5>
                <h5 class="text-center">Fecha: {{$solicitud->FechaRegistro}}</h5>
                <h5 class="text-center">Proveedor:{{$rz}} </h5>
            </div> 
        </div> 
    
      <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">         
            
          <table id="example" class="table table-hover table-bordered mt-2" style="width:100%">
              <thead>         
                  <tr class="bg-blue-50">      
                      <th class="text-center w-4" >ID</th>
                      <th class="text-center w-20" >Descripción</th>   
                      <th class="text-center w-4" >Cantidad</th>                                                                                                   
                  </tr>
              </thead>
              <tbody> 
              @foreach ($detalle as $d)            
                  <tr>                            
                    <td class="text-center" name="">{{$d->ArticuloID}}</td>
                    <td class="text-center" name="">{{$d->Descripcion}}</td>
                    <td class="text-center" name="">{{$d->Cantidad}}</td>                                  
                  </tr>                                                 
              @endforeach                           
            </tbody>         
          </table>                      
      </div>   
    </div>
</x-app-layout>

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
    