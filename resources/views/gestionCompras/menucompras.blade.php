<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestion de Compras') }}
        </h2>
    </x-slot>
        

    
    <div class="container-lg mx-auto mt-20">
        
        <div class="row">  
            
            <div class="col-4">
                 <!--Solicitudes de Compras Card's-->                    
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5 mb-5" src="/img/solCompra.png" alt="Solicitudes de Compras" >
                    <div class="text-center px-6 py-4">
                    <a href="{{route('compras.solicitudCompras')}}" class="btn btn-dark">Solicitud de Compra</a>                         
                    </div>
                </div>                
            </div>    
            
            <div class="col-4"> 
                 <!--Presupuestos Card's-->  
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5 mb-3" src="/img/presupuesto.png" alt="Presupuestos" >
                    <div class="text-center px-6 py-4">
                    <a href="{{route('compras.presupuestos')}}" class="btn btn-dark">Presupuestos</a>                         
                    </div>
                </div>
            </div> 

            <div class="col-4">                 
                 <!--Ordenes de Compras Card's-->  
                 <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                    <img class="rounded mx-auto d-block mt-5 mb-5" src="/img/compra.png" alt="Orden de Compra" >
                    <div class="text-center px-6 py-4">
                    <a href="{{route('compras.ordenes')}}" class="btn btn-dark">Orden de Compra</a>                         
                    </div>
                </div>
            </div>

        </div>  
    </div>
</x-app-layout>