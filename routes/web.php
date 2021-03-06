<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Livewire\UsuarioComponent;
use App\Http\Controllers\GestionUsuariosController;
use App\Http\Controllers\GestionPersonasController;
use App\Http\Controllers\GestionPermisosController;
use App\Http\Controllers\GestionSectoresController;
use App\Http\Controllers\GestionRolesController;
use App\Http\Controllers\GestionArticulosController;
use App\Http\Controllers\GestionOrdenesCompraController;
use App\Http\Controllers\GestionProveedoresController;
use App\Http\Controllers\GestionSolicitudComprasController;
use App\Http\Controllers\GestionPresupuestosController;
use App\Http\Controllers\PDFController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware(['auth:sanctum', 'verified'])->get('inicio', function () {
    /*$usuario='';
    $isresp=DB::table('usuarios_roles')
    ->where('usuario_roles.UsuarioID',Auth::id())
    $isadm=DB::table('usuarios_roles')

    $isdire=DB::table('usuarios_roles')

    $isSU=DB::table('usuarios_roles')

    */

    return view('/gestionCompras/menucompras');
})->name('dashboard');


//Menu de CARDS----------------------------------------------------------------------------------------------
Route::get('/gestionCompras', [PageController::class, 'gestionCompras'])->name('gestionCompras');
Route::get('/gestionInventario', [PageController::class, 'gestionInventario'])->name('gestionInventario');
Route::get('/gestionUsuarios', [PageController::class, 'gestionUsuarios'])->name('gestionUsuarios');
Route::get('/informes', [PageController::class, 'construction'])->name('informes');
Route::get('/configuracion', [PageController::class, 'construction'])->name('configuracion');

//Usuarios--------------------------------------------------------------------------------------------------------------
Route::get('/usuario/menu', [GestionUsuariosController::class, 'menu'])->name('usuario.menu');
Route::get('/usuarios/alta', [GestionUsuariosController::class, 'alta'])->name('usuario.alta');
Route::post('/usuario/registro', [GestionUsuariosController::class, 'store'])->name('usuario.registro');
Route::put('/usuario/editar',[GestionUsuariosController::class, 'editar'])->name('usuario.editar');
Route::put('/usuario/eliminar', [GestionUsuariosController::class, 'eliminar'])->name('usuario.eliminar');
Route::get('/usuario/{usuarioid}/menu_asignar_rol', [GestionUsuariosController::class, 'verAsignarRol'])->name('usuario.verAsignarRol');
Route::get('/usuario/{usuarioid}/menu_desasignar_rol', [GestionUsuariosController::class, 'verDesasignarRol'])->name('usuario.verDesasignarRol');
Route::post('/usuario/{usuarioid}/asignar_roles', [GestionUsuariosController::class, 'asignarRoles'])->name('usuario.asignarRoles');
Route::post('/usuario/usuarioid/{usuarioid}/desasignar_roles', [GestionUsuariosController::class, 'desasignarRoles'])->name('usuario.desasignarRoles');


//Personas--------------------------------------------------------------------------------------------------------------
Route::get('/personas/menu', [GestionPersonasController::class, 'menu'])->name('personas.menu');
Route::post('/personas/registro', [GestionPersonasController::class, 'store'])->name('persona.registro');
Route::put('/persona/editar',[GestionPersonasController::class, 'editar'])->name('persona.editar');
Route::put('/persona/eliminar', [GestionPersonasController::class, 'eliminar'])->name('persona.eliminar');
Route::get('/personas/menu_Activar_Personas', [GestionPersonasController::class, 'verActivarPersonas'])->name('persona.verActivarPersonas');
Route::post('/personas/activar_Personas', [GestionPersonasController::class, 'activarPersonas'])->name('persona.activarPersonas');


//Permisos--------------------------------------------------------------------------------------------------------------
Route::get('/permisos/alta',[GestionPermisosController::class,'registro'])->name('permiso.registro');
Route::post('/permisos/registrar',[GestionPermisosController::class,'store'])->name('permiso.store');
Route::get('/permisos/menu',[GestionPermisosController::class,'index'])->name('permiso.menu');
Route::put('/permisos/eliminar', [GestionPermisosController::class, 'eliminar'])->name('permiso.eliminar');

//Roles--------------------------------------------------------------------------------------------------------------
Route::get('/roles/alta',[GestionRolesController::class,'registro'])->name('rol.registro');
Route::post('/roles/registraRol',[GestionRolesController::class,'store'])->name('rol.store');
Route::post('/roles/{rolid}/asignar_permisos',[GestionRolesController::class,'asignarPermisos'])->name('rol.asignarPermisos');
Route::post('/roles/{rolid}/quitar_permisos',[GestionRolesController::class,'quitarPermisos'])->name('rol.quitarPermisos');
Route::get('/roles',[GestionRolesController::class,'index'])->name('rol.menu');
Route::get('/roles/{rolid}/menu_asignar_permisos',[GestionRolesController::class,'verAsignacionPermisos'])->name('rol.verAsignacionPermisos');
Route::get('/roles/{rolid}/menu_Quitar_permisos',[GestionRolesController::class,'verQuitarPermisos'])->name('rol.verQuitarPermisos');
Route::get('/roles/{rolid}/permisos',[GestionRolesController::class,'verPermisos'])->name('rol.verPermisos');


//Sectores----------------------------------------------------------------------------------------------------------
Route::get('/sectores/menu',[GestionSectoresController::class,'menu'])->name('sector.menu');
Route::post('/sectores/registro',[GestionSectoresController::class,'store'])->name('sector.registro');
Route::put('/sectores/editar',[GestionSectoresController::class, 'editar'])->name('sector.editar');
Route::put('/sectores/eliminar',[GestionSectoresController::class, 'eliminar'])->name('sector.eliminar');


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
Route::get('/gestionArticulos/menu_Activar_Articulos', [GestionArticulosController::class, 'verActivarArticulos'])->name('gestionArticulos.verActivarArticulos');
Route::post('/gestionArticulos/activar_Articulos', [GestionArticulosController::class, 'activarArticulos'])->name('gestionArticulos.activarArticulos');



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


//Administración de Solicitudes Compras-----------------------------------------------------------------------------------------
Route::get('/gestionCompras/solicitudesCompras',[GestionSolicitudComprasController::class,'index'] )->name('compras.solicitudCompras');
Route::get('/gestionCompras/solicitudesCompras/alta_sel_art', [GestionSolicitudComprasController::class,'seleccionarArticulos'])->name('compras.solicitudCompra.selecArticulos');
Route::post('/gestionCompras/solicitudesCompras/alta_cant_art', [GestionSolicitudComprasController::class,'cantidadArticulos'])->name('compras.solicitudCompra.cantArticulos');
Route::post('/gestionCompras/solicitudesCompras/registrarSolicitud', [GestionSolicitudComprasController::class,'registrarSolicitudCompra'])->name('compras.solicitudCompra.registrarSolicitudCompra');
Route::post('/gestionCompras/solicitudesCompras/detalle', [GestionSolicitudComprasController::class,'detalle'])->name('compras.solicitudCompra.detalle');
Route::post('/gestionCompras/solicitudesCompras/eliminar', [GestionSolicitudComprasController::class,'eliminar'])->name('compras.solicitudCompra.eliminar');
Route::get('/gestionCompras/solicitudesCompras/{solicitud}/editarSolicitud', [GestionSolicitudComprasController::class,'editarSolicitudCompra'])->name('compras.solicitudCompra.editar');
Route::put('/gestionCompras/solicitudesCompras/{solicitud}/actualizarSolicitud', [GestionSolicitudComprasController::class,'actualizar'])->name('compras.solicitudCompra.actualizar');



//Administración de Presupuestos---------------------------------------------------------------------------------------
Route::get('/gestionCompras/presupuestos',[GestionPresupuestosController::class,'index'] )->name('compras.presupuestos');
Route::get('/gestionCompras/presupuestos/solicitudCompraNro/{solicitud}',[GestionPresupuestosController::class,'solicitudesPresupuesto'] )->name('compras.presupuestos.solicitudes');
Route::get('/gestionCompras/presupuestos/solicitudCompraNro/{solicitud}/registrados',[GestionPresupuestosController::class,'presupuestosRegistrados'] )->name('compras.presupuestos.registrados');
Route::get('/gestionCompras/presupuestos/solicitudCompraNro/{solicitud}/solicitarPresupuesto',[GestionPresupuestosController::class,'solicitarPresupuesto'] )->name('compras.presupuestos.solicitar');
Route::get('/gestionCompras/presupuestos/presupuestoNro/{solicitud}/detalle',[GestionPresupuestosController::class,'detallePresuRegistrado'] )->name('compras.presupuestosRegistrados.verDetalle');
Route::get('/gestionCompras/presupuestos/solicitudNro/{solicitud}/detalle',[GestionPresupuestosController::class,'detallePresuSolicitado'] )->name('compras.presupuestoSolicitado.verDetalle');
Route::get('/gestionCompras/presupuestos/solicitudNro/{solicitud}/altaPresupuesto',[GestionPresupuestosController::class,'altaPresupuesto'] )->name('compras.presupuestos.alta');
Route::get('/gestionCompras/presupuestos/presupuestoNro/{solicitud}/seleccion',[GestionPresupuestosController::class,'seleccionPresuRegistrado'] )->name('compras.presupuestosRegistrados.seleccionPresuRegistrado');
Route::post('/gestionCompras/presupuestos/{solicitud}/registrarSolicitud',[GestionPresupuestosController::class,'registrarSolicitud'] )->name('compras.presupuestos.registrarSolicitud');
Route::post('/gestionCompras/presupuestos/{solicitud}/registrarPresupuesto',[GestionPresupuestosController::class,'registrarPresupuesto'] )->name('compras.presupuestos.registrarPresupuesto');
Route::post('/gestionCompras/presupuestos/registrarPresupuesto',[GestionPresupuestosController::class,'seleccionarDetallePresupuestoRegistrado'] )->name('compras.presupuestosRegistrados.seleccionDetalle');


//Administración de ordenes de compras
Route::get('/gestionCompras/ordenesCompra', [GestionOrdenesCompraController::class, 'index'])->name('compras.ordenes');
Route::get('/gestionCompras/ordenCompraNro/{ordencompra}/verDetalle', [GestionOrdenesCompraController::class, 'verDetalle'])->name('compras.ordenes.verDetalle');
Route::post('/gestionCompras/ordenCompraNro/aprobar', [GestionOrdenesCompraController::class, 'aprobar'])->name('compras.ordenes.aprobar');
Route::post('/gestionCompras/ordenCompraNro/rechazar', [GestionOrdenesCompraController::class, 'rechazar'])->name('compras.ordenes.rechazar');



//Controlador PDF
route::get('/gestionCompras/presupuestos/{solicitud}/descargar',[PDFController::class,'PDFSolPresu'])->name('descargarSolPresuPDF');