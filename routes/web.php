<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GestionUsuariosController;
use App\Http\Controllers\GestionPersonasController;
use App\Http\Controllers\GestionPermisosController;
use App\Http\Controllers\GestionSectoresController;
use App\Http\Controllers\GestionRolesController;
use App\Http\Controllers\GestionArticulosController;
use App\Http\Controllers\GestionProveedoresController;
use App\Http\Controllers\GestionSolicitudComprasController;
use App\Http\Livewire\UsuarioComponent;
use App\Http\Livewire\SolicitudComprasComponent;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('inicio', function () {
    return view('inicio');
})->name('dashboard');


//Menu de CARDS----------------------------------------------------------------------------------------------
Route::get('/gestionCompras', [PageController::class, 'gestionCompras'])->name('gestionCompras');
Route::get('/gestionInventario', [PageController::class, 'gestionInventario'])->name('gestionInventario');
Route::get('/gestionUsuarios', [PageController::class, 'gestionUsuarios'])->name('gestionUsuarios');
Route::get('/informes', [PageController::class, 'construction'])->name('informes');
Route::get('/configuracion', [PageController::class, 'construction'])->name('configuracion');

//Usuarios--------------------------------------------------------------------------------------------------------------
Route::get('/usuarios/alta', [GestionUsuariosController::class, 'alta'])->name('usuario.alta');
Route::post('/usuarios', [GestionUsuariosController::class, 'store'])->name('usuario.store');
Route::delete('/usuarios/{usuario}', [GestionUsuariosController::class, 'destroy'])->name('usuario.baja');
Route::put('/usuarios/{usuario}', [GestionUsuariosController::class, 'update'])->name('usuario.modificacion');
Route::get('/usuarios/consulta', UsuarioComponent::class)->name('usuario.consulta'); 

//Personas--------------------------------------------------------------------------------------------------------------
Route::get('/personas/alta', [GestionPersonasController::class, 'registro'])->name('persona.registro');
Route::post('/personas',[GestionPersonasController::class,'store'])->name('persona.store');

//Permisos--------------------------------------------------------------------------------------------------------------
Route::get('/permisos/alta',[GestionPermisosController::class,'registro'])->name('permiso.registro');
Route::post('/permisos',[GestionPermisosController::class,'store'])->name('permiso.store');

//Roles--------------------------------------------------------------------------------------------------------------
Route::get('/roles/alta',[GestionRolesController::class,'registro'])->name('rol.registro');
Route::post('/roles',[GestionRolesController::class,'store'])->name('rol.store');

//Sectores----------------------------------------------------------------------------------------------------------
Route::get('/sectores/alta',[GestionSectoresController::class,'registro'])->name('sector.registro');
Route::post('/sectores',[GestionSectoresController::class,'store'])->name('sector.store');


//Gestión de Articulos-----------------------------------------------------------------------------------------------
Route::get('/gestionArticulos/menu', [GestionArticulosController::class, 'menu'])->name('gestionArticulos.menu');
//Route::get('/articulos/gestion', [ArticuloComponent::class,'render'])->name('articulos.gestion'); 
Route::get('gestionArticulos/{ArticuloID}/vincular', [GestionArticulosController::class,'vincularProveedor'])->name('gestionArticulos.vincular');
Route::get('gestionArticulos/{ArticuloID}/desvincular', [GestionArticulosController::class,'desvincularProveedor'])->name('gestionArticulos.desvincular');
Route::put('/gestionArticulos/establecer', [GestionArticulosController::class, 'establecer'])->name('gestionArticulos.establecer');
Route::put('/gestionArticulos/ajustar', [GestionArticulosController::class, 'ajustar'])->name('gestionArticulos.ajustar');
Route::put('/gestinArticulos/{ArticuloID}/desasignarProveedor',[GestionArticulosController::class,'desasignarProveedor'])->name('gestionArticulos.desasignarProveedor');
Route::put('/gestionArticulos/editar',[GestionArticulosController::class, 'editar'])->name('gestionArticulos.editar');
Route::put('/gestionArticulos/eliminar',[GestionArticulosController::class, 'eliminar'])->name('gestionArticulos.eliminar');
Route::post('/gestionaArticulos/alta',[GestionArticulosController::class,'alta'])->name('gestionArticulos.alta'); 
Route::post('/gestionArticulos/{ArticuloID}/asignarProveedor',[GestionArticulosController::class,'asignarProveedor'])->name('gestionArticulos.asignarProveedor');



//Gestión de Proveedores--------------------------------------------------------------------------------------
Route::get('/gestionProveedores/menu', [GestionProveedoresController::class, 'menu'])->name('gestionProveedores.menu');
Route::put('/gestionProveedores/eliminar',[GestionProveedoresController::class, 'eliminar'])->name('gestionProveedores.eliminar');
Route::put('/gestionProveedores/editar',[GestionProveedoresController::class, 'editar'])->name('gestionProveedores.editar');
Route::post('/gestionProveedores/alta',[GestionProveedoresController::class,'alta'])->name('gestionProveedores.alta');



//Gestión de Inventario---------------------------------------------------------------------------------------
Route::get('/gestionInventario/puntoPedido', [GestionArticulosController::class, 'puntoPedido'])->name('gestionInventario.puntoPedido');
//Route::get('/gestionInventario/{path}/puntoPedido', [GestionArticulosController::class, 'direccionar'])->name('gestionInventario.puntoPedido');
Route::get('/gestionInventario/ajustarInventario', [GestionArticulosController::class, 'ajustarInventario'])->name('gestionInventario.ajustarInventario');
//Route::get('/gestionInventario/{path}/ajustarInventario', [GestionArticulosController::class, 'direccionar'])->name('gestionInventario.ajustarInventario');
Route::get('/gestionInventario/registrarRecepcion', [GestionArticulosController::class, 'registrarRecepcion'])->name('gestionInventario.registrarRecepcion');
//Route::get('/gestionInventario/{path}/registrarRecepcion', [GestionArticulosController::class, 'direccionar'])->name('gestionInventario.registrarRecepcion');
Route::get('/gestionInventario/verificarInventario', [GestionArticulosController::class, 'verificarInventario'])->name('gestionInventario.verificarInventario');
//Route::get('/gestionInventario/{path}/verificarInventario', [GestionArticulosController::class, 'direccionar'])->name('gestionInventario.verificarInventario');


//Gestion de Compras-----------------------------------------------------------------------------------------
Route::get('/gestionCompras/solicitudesCompras',[GestionSolicitudComprasController::class,'index'] )->name('compras.solicitudCompras');
Route::get('/gestionCompras/solicitudesCompras/alta_sel_art', [GestionSolicitudComprasController::class,'seleccionarArticulos'])->name('compras.solicitudCompra.selecArticulos');
Route::post('/gestionCompras/solicitudesCompras/alta_cant_art', [GestionSolicitudComprasController::class,'cantidadArticulos'])->name('compras.solicitudCompra.cantArticulos');
Route::post('/gestionCompras/solicitudesCompras/registrarSolicitud', [GestionSolicitudComprasController::class,'registrarSolicitudCompra'])->name('compras.solicitudCompra.registrarSolicitudCompra');