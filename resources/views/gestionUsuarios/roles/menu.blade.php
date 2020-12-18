<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestión de Roles') }}
        </h2>
    </x-slot>

    <div class="container-lg mx-auto mt-2">
        <div class="d-flex justify-content-center"> 
          <!-- Boton trigger modal alta-->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAlta">Alta de Rol</button>
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
                        <th class="text-center" style="width:10%">Rol ID</th>
                        <th class="text-center" style="width:15%">Fecha de Creación</th> 
                        <th class="text-center" style="width:15%">Permisos</th> 
                    </tr>
                </thead>
                <tbody>
                @foreach ($roles as $r)
                    <tr>                
                        <td class="text-center">{{$r->RolID}}</td>                        
                        <td>{{$r->created_at}}</td>
                        <td class="text-center">
                            <a href="{{route('rol.verAsignacionPermisos',$r->RolID)}}" class="btn btn-outline-info btn-sm">Asignar Permisos</a>
                        </td>
        
                    </tr>                                                                           
                @endforeach                  
                </tbody>         
            </table>                      
        </div>   
    </div>

</x-app-layout>