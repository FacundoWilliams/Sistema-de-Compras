<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestion de Inventario') }}
        </h2>
    </x-slot>       
    
    <div class="container-lg mx-auto mt-4">
        
        <div class="row offset-1">  
            
            <div class="col-4">
                 <!--Establecer Punto de Pedido Card's-->                    
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5 mb-3" src="/img/puntop.png" alt="Establecer Punto de Pedido" >
                    <div class="text-center px-6 py-4">
                    <a href="{{route('gestionInventario.puntoPedido','puntoPedido')}}" class="btn btn-dark">Establecer punto de pedido</a>                     
                    </div>
                </div>                
            </div>    
            
            <div class="col-4"> 
                 <!--Ajustar Inventario Card's-->  
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5" src="/img/egreso.png" alt="Ajustar Inventario" >
                    <div class="text-center px-6 py-4">
                        <a href="{{route('gestionInventario.ajustarInventario','ajustarInventario')}}" class="btn btn-dark">Ajustar inventario</a>
                    </div>
                </div>
            </div> 

        </div>

        <div class="row offset-1 mt-10">  
            
            <div class="col-4">
                 <!--Registrar recepción de articulos Card's-->                    
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block py-6" src="/img/ingreso.png" alt="Registro de Pedidos" >
                    <div class="text-center px-6 py-4">
                        <a href="{{route('gestionInventario.registrarRecepcion')}}" class="btn btn-dark">Registrar recepción de artículos</a>
                    </div>
                </div>                
            </div>    
            
            <div class="col-4"> 
                <!--Verificación de inventario Card's-->    
                <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5" src="/img/verificar.png" alt="Verificación de Inventario" >
                    <div class="text-center px-6 py-4">
                        <a href="{{ route('gestionInventario.verificarInventario') }}" class="btn btn-dark">Verificar inventario</a>
                    </div>
                </div>
            </div> 
            
        </div>
          
        </div>  
</x-app-layout>