<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Gestion de Compras') }}
        </h2>
    </x-slot>
        
        <div class="flex flex-wrap justify-center bg-gray-100 ml-64 mr-64 mt-32">

            <div class="w-1/3 p-4 bg-gray-100">                
                <div class="text-gray-700 text-center bg-gray-100 p-4">                   
                    <!--Solicitudes de Compras Card's-->                    
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                        <img class="rounded mx-auto d-block mt-5 mb-5" src="/img/solCompra.png" alt="Solicitudes de Compras" >
                        <div class="px-6 py-4">
                        <a href="{{route('compras.solicitudCompras')}}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Solicitud de Compra</a>                         
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-1/3 p-4 bg-gray-100">                
                <div class="text-gray-700 text-center bg-gray-100 p-4"> 
                    <!--Presupuestos Card's-->  
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                        <img class="rounded mx-auto d-block mb-2" src="/img/presupuesto.png" alt="Presupuestos" >
                        <div class="px-6 py-4">
                        <a href="{{route('compras.presupuestos')}}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Presupuestos</a>                         
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-1/3 p-4 bg-gray-100">                
                <div class="text-gray-700 text-center bg-gray-100 p-4"> 
                    <!--Ordenes de Compras Card's-->  
                    <div class="max-w-sm rounded overflow-hidden shadow-lg pb-10">                        
                        <img class="rounded mx-auto d-block mt-3 mb-5" src="/img/compra.png" alt="Orden de Compra" >
                        <div class="px-6 py-4">
                        <a href="{{route('compras.ordenes')}}" class="btn btn-success  bg-gray-300 text-gray-600 font-bold px-2 py-1 rounded-lg  hover:bg-gray-500 hover:text-white">Orden de Compra</a>                         
                        </div>
                    </div>
                </div>
            </div>
             
        </div>  
</x-app-layout>