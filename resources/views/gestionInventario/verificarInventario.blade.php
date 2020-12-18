<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Registrar Recepción de Artículos') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">
        <div class="row">
            <div class="col-4">
              <a class="btn btn-danger" href="{{route('gestionInventario')}}" role="button">Atras</a>
            </div>    
        </div>

        <div class="container-lg sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">
            <table id="example" class="table table-hover table-bordered" style="width:100%">
                <thead>         
                    <tr class="bg-blue-50">           
                        <th class="text-center" style="width:1%">ID</th>
                        <th class="text-center" style="width:40%">Artículo</th>          
                        <th class="text-center" style="width:10%">Stock</th> 
                        <th class="text-center" style="width:10%">Punto Pedido</th>  
                        <th class="text-center" style="width:10%">Excedente</th>                                                                      
                    </tr>
                </thead>
                <tbody>
                @foreach ($articulos as $a) 
                  @if ( $a->Activo == 1 )
                    <tr>                
                        <td class="text-center">{{$a->ArticuloID}}</td>                        
                        <td>{{$a->Descripcion}}</td>                 
                        <td class="text-center">{{$a->Stock_disponible}}</td>             
                        <td class="text-center">{{$a->Punto_pedido}}</td>  
                        <td class="text-center">
                            <?php $excedente = $a->Stock_disponible - $a->Punto_pedido?>                                                                                                             
                            @php
                                echo $excedente
                            @endphp                                 
                        </td>                          
                    </tr>                                              
                  @endif                               
                @endforeach                  
                </tbody>         
            </table>                      
        </div>   
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








 