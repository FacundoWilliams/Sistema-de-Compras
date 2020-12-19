<x-app-layout>
<x-slot name="header">
  <h2 class="font-bold text-xl text-blue-800 leading-tight">
      {{ __('Solicitar Presupuesto') }}
  </h2>
</x-slot>
<div class="container h-auto mx-auto mt-2">
  <div class="row">
      <div class="col-4">
        <a class="btn btn-danger" href="{{route('compras.presupuestos.solicitudes',$solicitud)}}" role="button">Atras</a>
      </div>     
      <div class="col-sm-4 overflow-hidden shadow-md sm:rounded-lg bg-white p-2">  
            <h3 class="text-center">Solicitud de Compra Nº: {{$solicitud}}</h3>
        </div> 
    </div> 

<form id="frm-example" action="{{route('compras.presupuestos.registrarSolicitud',$solicitud)}}" method="POST">
    @csrf 
  <div class="container h-auto sm:rounded-md shadow-md mx-auto mt-2 p-2 bg-white">     
    @if (session('success'))
    <div class="alert alert-success" role="success">
        {{ session('success') }}
    </div> 
    @endif 
    <div class="alert alert-warning" role="alert">
      <strong>Si no visualiza Articulos se debe a que no estan Activos o no tienen Proveedores Vinculados</strong>
      <button type="button" class="close" data-dismiss="alert" alert-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
    </div>
        <div class="d-flex justify-content-center"> 
            <button type="submit" class="btn btn-primary">Solicitar</button>
        </div>
      <table id="example" class="table table-hover table-bordered" style="width:100%">
          <thead>         
              <tr class="bg-blue-50">      
                  <th><input name="select_all" value="1" type="checkbox"></th>    
                  <th class="text-center w-4" >ID</th>
                  <th class="text-center w-20" >Descripción</th>   
                  <th class="text-center w-4" >Cantidad</th>               
                  <th class="text-center w-12">Fecha de Resposición</th>   
                  <th class="text-center w-4"> ID-Proveedor</th>                             
                  <th class="text-center w-16">Proveedor</th>  
              </tr>
          </thead>
          <tbody> 
          @foreach ($artSolicitados as $a)            
              <tr> 
                  <td></td>                            
                  <td class="text-center" name="">{{$a->ArticuloID}}</td>
                  <td class="text-center" name="">{{$a->Descripcion}}</td>
                  <td class="text-center" name="">{{$a->Cantidad}}</td>
                  <td class="text-center" name="">{{$a->FechaResposicionEstimada}}</td>  
                  <td>{{$a->ProveedorID}}</td>
                  <td class="text-center" name="">{{$a->Nombre}}</td>
                  {{--<input type="hidden" name="proveedores[]" value="{{$a->ProveedorID}}" --}}
                  {{--<input type="hidden" name="cantidades[]" value="{{$a->Cantidad}}" >--}}
              </tr>                                                 
          @endforeach                           
        </tbody>         
      </table>                      
  </div>   
</div>
</form> 
</x-app-layout>


<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

@livewireScripts

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
    var prov_selected=[];
    var cant_selected=[];
    var fp_selected=[];

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
        var provID=data[5];
        var cantID=data[3];
        var fpID=data[4];

        // If row ID is in the list of selected row IDs
        if($.inArray(rowId, rows_selected) !== -1){
          $(row).find('input[type="checkbox"]').prop('checked', true);
          $(row).addClass('selected');
        }
         //copia del de arriba para array proveedores
        if($.inArray(provID, prov_selected) !== -1){
          $(row).find('input[type="checkbox"]').prop('checked', true);
          $(row).addClass('selected');
        }
        //copia del de arriba para array cantidades
        if($.inArray(cantID, cant_selected) !== -1){
          $(row).find('input[type="checkbox"]').prop('checked', true);
          $(row).addClass('selected');
        }
        //copia del de arriba para array cantidades
        if($.inArray(fpID, fp_selected) !== -1){
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
      //nosotros copiamos de arriba
      var provID=data[5];
      var cantID=data[3];
      var fpID=data[4];

      // Determine whether row ID is in the list of selected row IDs 
      var index = $.inArray(rowId, rows_selected);
      //nosotros copiamos de arriba
      var index2 = $.inArray(provID, prov_selected);
      var index3 = $.inArray(cantID, cant_selected);
      var index4 = $.inArray(fpID, fp_selected);

      // If checkbox is checked and row ID is not in list of selected row IDs
      if(this.checked){// && index === -1){
        rows_selected.push(rowId);
      //nosotros copiamos de arriba
        prov_selected.push(provID);
        cant_selected.push(cantID);
        fp_selected.push(fpID);
      // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
      }else 
      if (!this.checked && index !== -1){
        prov_selected.splice(index2, 1);
        rows_selected.splice(index, 1);
        cant_selected.splice(index3, 1);
        fp_selected.splice(index4, 1);
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

        })
        
        $.each(cant_selected, function(index3, cantID){  
          // Create a hidden element 
          $(form).append(
            $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'cantidades[]')
              .val(cantID)
          );

        })

        $.each(prov_selected, function(index2, provID){ 
          // Create a hidden element 
          $(form).append(
            $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'proveedores[]')
              .val(provID)
          );

        })

        $.each(fp_selected, function(index4, fpID){  
          // Create a hidden element 
          $(form).append(
            $('<input>')
              .attr('type', 'hidden')
              .attr('name', 'fps[]')
              .val(fpID)
          );

        })


      });

    });
  
</script>
