<x-app-layout>
    <x-slot name="header">
      <h2 class="font-bold text-xl text-blue-800 leading-tight">
          {{ __('Detalle de Presupuesto Registrado') }}
      </h2>
    </x-slot>

    <div class="container h-auto mx-auto mt-3">
      <div class="row justify-content-start">
        <div class="col-md-3">
          <a class="btn btn-danger" href={{route('compras.presupuestos.registrados',$idSol)}} role="button">Atras</a>
        </div> 
      </div>
        <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-3 p-2 bg-white">       
                <div class="row justify-content-center">
                  <div class="col-md-4 mt-2 border-2 border-grey-700">
                    <label for="#persuNro">Proveedor</label> 
                    <h3 class="text-grey-800" name="proveedor">{{$prove[0]->Razon_social}}</h3>
                  </div>                        
                </div>           
                <div class="row justify-content-center mt-3 py-2">
                  <div class="col-md-3 border-2 border-grey-700 py-2">
                    <label for="#persuNro">Presupuesto Nº: </label> 
                    <h3 class="text-grey-800" name="proveedor">{{$detalle[0]->NroPresupuesto}}</h3>
                  </div>
                  <div class="col-md-3 border-2 border-grey-700 py-2">
                    <label for="#persuNro">Fecha de validez: </label>              
                    <h3 class="text-grey-800" name="proveedor">{{$detalle[0]->FechaValidez}}</h3>
                  </div>  
                  <div class="col-md-3 border-2 border-grey-700 py-2">
                    <label for="#persuNro">Fecha de entrega: </label>              
                    <h5 class="text-grey-800" name="proveedor">{{$detalle[0]->FechaEntregaEstimada}}</h5>
                  </div>                   
                </div>                                             
              <table id="example" class="table table-hover table-bordered mt-3" style="width:100%">
                <thead>         
                    <tr class="bg-blue-50">           
                        <th class="text-center" style="width:5%">Articulo</th>                 
                        <th class="text-center" style="width:40%">Descripcion</th>                                 
                        <th class="text-center" style="width:10%">Cantidad</th>  
                        <th class="text-center" style="width:15%">Precion Unitario $</th>  
                        <th class="text-center" style="width:15%">Descuento %</th>   
                        <th class="text-center" style="width:15%">Subtotal </th>   
                    </tr>
                </thead>
                <tbody> 
                @php
                    $i = 0;
                @endphp
                @foreach ($detalle as $d)            
                    <tr>               
                        <td class="text-center">{{$d->ArticuloID}}</td>
                        <td class="text-center">{{$d->Descripcion}}</td>
                        <td class="text-center">{{$d->Cantidad}}</td>
                        <td class="text-center">{{$d->PrecioUnitario}}</td>
                        <td class="text-center">{{$d->Descuento}}</td>                                                               
                        <td class="text-center">{{$subtotal[$i]}}</td>                                                               
                        @php
                            $i++;
                        @endphp
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
    