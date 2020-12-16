<x-app-layout>
    <x-slot name="header">
      <h2 class="font-bold text-xl text-blue-800 leading-tight">
          {{ __('Selección de Presupuesto Registrado') }}
      </h2>
    </x-slot>

    <div class="container h-auto mx-auto mt-3">
      <div class="row justify-content-start">
        <div class="col-md-3">
          <a class="btn btn-danger" href={{route('compras.presupuestos.registrados',$solCompra)}} role="button">Atras</a>
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
              <form id="frm-example" action="{{route('compras.presupuestosRegistrados.seleccionDetalle')}}" method="POST">
              @csrf      
              <input type="hidden" name="total" value="{{$prove[0]->Total}}">
              <input type="hidden" name="presupuesto" value="{{$idPresu}}">          
              <table id="example" class="table table-hover table-bordered mt-3" style="width:100%">
                <div class="d-flex justify-content-center mt-3"> 
                  <button type="submit" class="btn btn-primary">Seleccionar</button>
                </div>  
                <caption style="caption-side: top; text-align: center; font-style: italic;">Seleccione el o los artículos que desea comprar</caption>
                <thead>                                           
                    <tr class="bg-blue-50">  
                        <th><input name="select_all" value="1" type="checkbox"></th>           
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
                        <th></th>                           
                        <td class="text-center">{{$d->ArticuloID}}</td>
                        <td class="text-center">{{$d->Descripcion}}</td>
                        <td class="text-center">{{$d->Cantidad}}</td>
                        <input type="hidden" name="cantidad[]" value="{{$d->Cantidad}}">  
                        <td class="text-center">{{$d->PrecioUnitario}}</td>
                        <input type="hidden" name="precioUni[]" value="{{$d->PrecioUnitario}}">  
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
                  <h3 class="text-grey-800" name="total">$ {{$prove[0]->Total}}</h3>
                </div>                        
              </div>                   
        </div> 
    
    </div>
</x-app-layout>

<!--Script del datatable-->
<script>
  
  function updateDataTableSelectAllCtrl(table){
    var $table             = table.table().node();
    var $chkbox_all        = $('tbody input[type="checkbox"]', $table);
    var $chkbox_checked    = $('tbody input[type="checkbox"]:checked', $table);
    var chkbox_select_all  = $('thead input[name="select_all"]', $table).get(0);

    // If none of the checkboxes are checked
    if($chkbox_checked.length === 0){
      chkbox_select_all.checked = false;
      if('indeterminate' in chkbox_select_all){
          chkbox_select_all.indeterminate = false;
      }
    }
    // If all of the checkboxes are checked
    else if ($chkbox_checked.length === $chkbox_all.length){
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
        chkbox_select_all.indeterminate = false;
      }
    }
    // If some of the checkboxes are checked
    else {
      chkbox_select_all.checked = true;
      if('indeterminate' in chkbox_select_all){
        chkbox_select_all.indeterminate = true;
      }
    }
  }

  $(document).ready(function (){
    
    // Array holding selected row IDs
    var rows_selected = [];

    var table = $('#example').DataTable({  
      
      "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
      },

      'columnDefs': [{
        'targets': 0,
        'searchable':false,
        'orderable':false,
        'width':'2%',
        'className': 'dt-body-center',
        'render': function (data, type, full, meta){
          return '<input type="checkbox">';
        }
      }],     

      'order': [1, 'asc'],

      'rowCallback': function(row, data, dataIndex){
        // Get row ID
        var rowId = data[1];

        // If row ID is in the list of selected row IDs
        if($.inArray(rowId, rows_selected) !== -1){
          $(row).find('input[type="checkbox"]').prop('checked', true);
          $(row).addClass('selected');
        }
      }

    });

    // Handle click on checkbox
    $('#example tbody').on('click', 'input[type="checkbox"]', function(e){
      var $row = $(this).closest('tr');

      // Get row data
      var data = table.row($row).data();

      // Get row ID
      var rowId = data[1];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked && index === -1){
        rows_selected.push(rowId);
      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      }else if (!this.checked && index !== -1){
        rows_selected.splice(index, 1);
      }

      if(this.checked){
        $row.addClass('selected');
      }else {
        $row.removeClass('selected');
      }

      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);

      // Prevent click event from propagating to parent
      e.stopPropagation();
    });

    // Handle click on table cells with checkboxes
    $('#example').on('click', 'tbody td, thead th:first-child', function(e){
      $(this).parent().find('input[type="checkbox"]').trigger('click');
    });

    // Handle click on "Select all" control
    $('thead input[name="select_all"]', table.table().container()).on('click', function(e){
      if(this.checked){
        $('#example tbody input[type="checkbox"]:not(:checked)').trigger('click');
      }else {
        $('#example tbody input[type="checkbox"]:checked').trigger('click');
      }

      // Prevent click event from propagating to parent
      e.stopPropagation();
    });

    // Handle table draw event
    table.on('draw', function(){
      // Update state of "Select all" control
      updateDataTableSelectAllCtrl(table);
    });
      
    // Handle form submission event 
    $('#frm-example').on('submit', function(e){
      var form = this;

        // Iterate over all selected checkboxes
        $.each(rows_selected, function(index, rowId){
          // Create a hidden element 
          $(form).append(
            $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'id[]')
              .val(rowId)
          );
        });

      });

    });
  
</script>