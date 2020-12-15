<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Registro de Presupuesto') }}
  </h2>
</x-slot>

<div class="container h-auto mx-auto mt-3">
  <div class="row justify-content-start">
    <div class="col-md-3">
      <a class="btn btn-danger" href={{route('compras.presupuestos.solicitudes',$solCompra)}} role="button">Atras</a>
    </div> 
  </div>
    <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-3 p-2 bg-white">       
      <form id="frm-example" action={{route('compras.presupuestos.registrarPresupuesto',$detalle[0]->SoliPresuID)}} method="POST">          
        @csrf                                                                      
            <div class="row justify-content-center">
              <div class="col-md-3 mt-2 border-2 border-grey-700">
                <input type="hidden" name="proveID" value="{{$detalle[0]->ProveedorID}}">             
                <h3 class="text-grey-800" name="proveedor">Proveedor: {{$detalle[0]->Razon_social}}</h3>
              </div>                        
            </div>           
            <div class="row justify-content-center mt-3 py-2">
              <div class="col-md-3 border-2 border-grey-700 py-2">
                <label for="#persuNro">Presupuesto Nº: </label>              
                <input class="form-control" type="text" id="presuNro" name="presuNro" required>             
              </div>
              <div class="col-md-3 border-2 border-grey-700 py-2">
                <label for="#persuNro">Fecha de validez: </label>              
                <input class="form-control" type="date" id="fechaVal" name="fechaVal" required>             
              </div>  
              <div class="col-md-3 border-2 border-grey-700 py-2">
                <label for="#persuNro">Fecha de entrega: </label>              
                <input class="form-control" type="date" id="fechaVal" name="fechaVal" required>             
              </div>                   
            </div>   
            <div class="row justify-content-center">
              <div class="col-md-1">
                <button type="submit" class="btn btn-primary mt-2 p-2">Registrar</button>
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
                </tr>
            </thead>
            <tbody> 
            @foreach ($detalle as $d)            
                <tr>               
                    <td class="text-center">
                      {{$d->ArtiID}}
                      <input type="hidden" name="artID[]" value="{{$d->ArtiID}}">             
                    </td>
                    <td class="text-center">{{$d->Descripcion}}</td>
                    <td class="text-center">
                      <input class="form-control text-center" type="number" name="cantidad[]" value="{{$d->Cantidad}}" min="0" max={{$d->Cantidad}} style="width: 6em" required>             
                    </td>
                    <td>
                      <input class="form-control text-center ml-3" type="number" name="precioUni[]" value="0" min="0" style="width: 8em" required>             
                    </td>
                    <td class="text-center"> 
                      <input class="form-control text-center" type="number" name="descuento[]" value="0" min="0" style="width: 8em" required>              
                    </td>                                                               
                </tr>                                                     
            @endforeach                           
            </tbody>         
          </table>                           
      </form>    
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

