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
                <thead>         
                    <tr class="bg-blue-50">           
                        <th class="text-center" style="width:1%">ID</th>
                        <th class="text-center" style="width:40%">Artículo</th>          
                        <th class="text-center" style="width:10%">Stock</th>                                                
                        <th class="text-center" style="width:10%">Acción</th>                     
                    </tr>
                </thead>
                <tbody>
                @foreach ($articulos as $a) 
                  @if ( $a->Activo == 1 )
                    <tr>                
                        <td class="text-center">{{$a->ArticuloID}}</td>                        
                        <td class="text-center">{{$a->Descripcion}}</td>                 
                        <td class="text-center">{{$a->Stock_disponible}}</td>             
                        <td class="text-center">
                            <!-- Boton trigger modal Registrar-->
                            <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#modalRegistrar" 
                            data-id={{$a->ArticuloID}}
                            data-descripcion="{{$a->Descripcion}}"
                            data-stock={{$a->Stock_disponible}}
                            >
                                Mostrar
                            </button>                                           
                        </td>                           
                    </tr>                                              
                  @endif                               
                @endforeach                  
                </tbody>         
            </table>                      
        </div>   
    </div>
</x-app-layout>

<!-- Modal Registrar -->
<div class="modal fade" id="modalRegistrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Registrar recepción</h5>        
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action={{route('gestionArticulos.ajustar')}} method="POST">
        @csrf 
        @method('put')
        <div class="modal-body">                
          <div class="form-group row">        
            <div class="col">
              <input class="form-control" type="hidden" id="id" name="id">                   
              <h3 class="text-center text-cool-gray-500"></h3>           
            </div>
          </div>             
          <div class="form-group row">                         
            <div class="col">
              <label for="#punto_pedido" class="ml-5">Stock actual</label>
              <h5 class="text-center text-cool-gray-500"></h5>           
            </div>  
            <div class="col">
                <label for="#ajuste" class="ml-4">Valor de Ajuste</label>
                <input class="form-control ml-4" type="number" id="ajuste" name="ajuste" min="1" max="100">  
              </div>            
          </div> 
        </div>
  
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>        
          <button type="submit" class="btn btn-primary">Registrar</button>
        </div>
      </form>
      </div>
    </div>
</div>

@livewireStyles

<style type="text/css">
#ajuste {
  width: 7em;
}
</style>


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

<!--Script del modal establecer -->
<script> 
    $('#modalRegistrar').on('show.bs.modal', function(e) {    
      var id = $(e.relatedTarget).data('id');  
      var descripcion = $(e.relatedTarget).data('descripcion');     
      var stock =  $(e.relatedTarget).data('stock');  
      $(e.currentTarget).find('#id').val(id);
      $(".modal-body h3").text(descripcion);      
      $(".modal-body h5").text(stock);   
    });
  </script>









 