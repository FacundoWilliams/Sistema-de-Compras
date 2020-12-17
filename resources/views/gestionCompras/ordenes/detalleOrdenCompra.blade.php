<x-app-layout>
    <x-slot name="header">
      <h2 class="font-bold text-xl text-blue-800 leading-tight">
          {{ __('Detalle de Orden de Compra') }}
      </h2>
    </x-slot>

    <div class="container h-auto mx-auto mt-3">
      <div class="row justify-content-start">
        <div class="col-md-3">
          <a class="btn btn-danger" href={{route('compras.ordenes')}} role="button">Atras</a>
        </div> 
      </div>    
        <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-3 p-2 bg-white">       
          @if ($estado == 'Rechazada')
            <div class="alert alert-danger" role="alert">
              <strong>Estado de la orden de Compra: {{$estado}} </strong>
              <button type="button" class="close" data-dismiss="alert" alert-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>                    
          @endif  
          @if ($estado == 'Aprobada')
          <div class="alert alert-success" role="alert">
            <strong>Estado de la orden de Compra: {{$estado}}</strong>
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
                  <div class="col-md-4 mt-2 border-2 border-grey-700">
                    <label for="#persuNro">Proveedor</label> 
                    <h3 class="text-grey-800" name="proveedor">{{$proveedor}}</h3>
                  </div>                        
                </div>           
                <div class="row justify-content-center mt-3 py-2">
                  <div class="col-md-3 border-2 border-grey-700 py-2">
                    <label for="#persuNro">Orden de Compra Nº: </label> 
                    <h3 class="text-grey-800" name="proveedor">{{$detalle[0]->OrdenCompraID}}</h3>
                  </div>
                  <div class="col-md-3 border-2 border-grey-700 py-2">
                    <label for="#persuNro">Fecha: </label>              
                    <h3 class="text-grey-800" name="proveedor">{{$detalle[0]->FechaRegistro}}</h3>
                  </div>                    
                </div>
                <div class="row justify-content-center mt-3">                                
                    @if ($estado == 'Pendiente')                           
                    <div class="col-md-1">                   
                      <!-- Boton trigger modal aprobar -->
                      <button type="button" class="btn btn-success btn-md" data-toggle="modal" data-target="#modalAprobar" 
                        data-id={{$detalle[0]->OrdenCompraID}}
                        data-total="{{$detalle[0]->Total}}">
                          Aprobar
                      </button>
                    </div>
                    <div class="col-md-1">
                      <!-- Boton trigger modal rechazar -->
                      <button type="button" class="btn btn-danger btn-md" data-toggle="modal" data-target="#modalRechazar" 
                        data-id={{$detalle[0]->OrdenCompraID}}
                        data-total="{{$detalle[0]->Total}}">
                          Rechazar
                      </button>
                    </div>                    
                    @endif
                    <div class="col-md-2 ml-2">
                      <a class="btn btn-info" href='' role="button">Descargar PDF</a>
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
              <div class="row justify-content-end">
                <div class="col-md-3 mt-2 mr-4 border-2 border-grey-700">
                  <label for="#total">Total</label> 
                  <h3 class="text-grey-800" name="total">$ {{$detalle[0]->Total}}</h3>
                </div>                        
              </div>                   
        </div> 
    
    </div>
</x-app-layout>

<!-- Modal Aprobar -->
<div class="modal fade" id="modalAprobar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Aprobación de la Orden de compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>    
      <form action="{{route('compras.ordenes.aprobar')}}" method="POST">
      <!-- Se agrega @csrf para que se genere un token oculto para este form -->
      @csrf        
      <div class="modal-body">
        <input class="form-control" type="hidden" id="id" name="id">   
        <p class="text-center">
          ¿Desea aprobar la Órden de Compra con el siguiente monto?
        </p>
        <h5 class="text-center"></h5>       
      </div>
      <div class="modal-footer">      
        <button type="submit" class="btn btn-primary">Aprobar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>   
    </form>
    </div>
  </div>
</div>

<!-- Modal Rechazar -->
<div class="modal fade" id="modalRechazar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Rechazo de la Orden de compra</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>    
      <form action="{{route('compras.ordenes.rechazar')}}" method="POST">
      <!-- Se agrega @csrf para que se genere un token oculto para este form -->
      @csrf        
      <div class="modal-body">
        <input class="form-control" type="hidden" id="id" name="id">   
        <p class="text-center">
          ¿Desea rechazar la Órden de Compra con el siguiente monto?
        </p>
        <h5 class="text-center"></h5>       
      </div>
      <div class="modal-footer">      
        <button type="submit" class="btn btn-primary">Rechazar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
      </div>   
    </form>
    </div>
  </div>
</div>



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
  
<!--Script del modal aprobar -->
<script> 
  $('#modalAprobar').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var total = $(e.relatedTarget).data('total');    
    total = '$ ' + total; 
    $(e.currentTarget).find('#id').val(id);
    $(".modal-body h5").text(total);
  });
</script>

<!--Script del modal rechazar -->
<script> 
  $('#modalRechazar').on('show.bs.modal', function(e) {
    var id = $(e.relatedTarget).data('id');
    var total = $(e.relatedTarget).data('total');    
    total = '$ ' + total; 
    $(e.currentTarget).find('#id').val(id);
    $(".modal-body h5").text(total);
  });
</script>