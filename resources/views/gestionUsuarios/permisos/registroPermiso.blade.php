<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-blue-800 leading-tight">
            {{ __('Alta de Permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            </div>
        </div>
    </div>
    <!-- Formulario de Alta-->
    <div class="container-lg mx-auto mt-2">
        <form action="{{route('permiso.store')}}" method="POST">
            <!-- Se agrega @csrf para que se genere un token oculto para este form -->
            @csrf 
            <label>
                IDPermiso
                <input type="text" name="permisoID">
            </label>
            <label>
                Descripción
            </label>
            <textarea name="descripcion" id="" cols="30" rows="10"></textarea>
            <label>
                Permiso
                Acciones Disponibles Según Entidades:
                <table id="example" class="table table-bordered" style="width:100%">
                    <thead>                   
                         <tr>
                            <th>Articulos</th>
                            <th>Proveedore</th>
                            <th>Vinculacion Proveedor</th>
                            <th>Solicitudes de Compra</th>
                            <th>Solicitudes de Presupuesto</th>
                            <th>Presupuestos</th>
                            <th>Ordenes de Compra</th>

                        </tr>
                    </tr>
                </thead>
                <tbody>
                         <tr>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/Ar/Alta">                   
                               </label> 
                               <br>
                               <label for=""> Baja
                                    <input type="radio" name="opcion" value="/Ar/Baja">                   
                               </label> 
                               <br>
                               <label for=""> Modificar
                                    <input type="radio" name="opcion" value="/Ar/Modificar" >                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/Ar/Consultar">                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/Prov/Alta">                   
                               </label> 
                               <br>
                               <label for=""> Baja
                                    <input type="radio" name="opcion" value="/Prov/Baja" >                   
                               </label> 
                               <br>
                               <label for=""> Modificar
                                    <input type="radio" name="opcion" value="/Prov/Modificar">                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/Prov/Consultar">                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Vincular
                                    <input type="radio" name="opcion" value="/ProvAr/Vincular" >                   
                               </label>  
                               <br>
                               <label for=""> Desvincular
                                    <input type="radio" name="opcion" value="/ProvAr/Desvincular">                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/ProvAr/Consultar" >                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/SC/Alta" >                   
                               </label> 
                               <br>
                               <label for=""> Baja
                                    <input type="radio" name="opcion" value="/SC/Baja" >                   
                               </label> 
                               <br>
                               <label for=""> Modificar
                                    <input type="radio" name="opcion" value="/SC/Modificar" >                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/SC/Consultar">                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/SP/Alta" >                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/SP/Consultar">                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/Pres/Alta">                   
                               </label>  
                               <br>
                               <label for=""> Modificar
                                    <input type="radio" name="opcion" value="/Pres/Consultar" >                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/Pres/Modificar" >                   
                               </label> 
                            </td>
                            <td>
                               <label for=""> Alta 
                                    <input type="radio" name="opcion" value="/OC/Alta" >                   
                               </label>  
                               <br>
                               <label for=""> Modificar
                                    <input type="radio" name="opcion" value="/OC/Consultar" >                   
                               </label> 
                               <br>
                               <label for=""> Consultar
                                    <input type="radio" name="opcion" value="/OC/Modificar" >                   
                               </label> 
                            </td>
                            
                        </tr>      
                </tbody>         
            </table>
            </label>
            <button type="submit">Resgitrar Permiso</button>
        </form>
</x-app-layout>
@livewireStyles