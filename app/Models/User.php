<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'Legajo',
        'Activo',
    ];

    /**---------------Permisos de Articulos----------------------------
     * Ver permisos de Alta
     */
    public function canAltaArt() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Ar/Alta')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos de Baja
     */
    public function canBajaArt() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Ar/Baja')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos para Modificar 
     */
    public function canModificarArt() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Ar/Modificar')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos para Consultar 
     */
    public function canConsultaArt() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Ar/Consultar')
        ->value('PathAuth');

        return $path != null ; 
    }



/**---------------Permisos de Proveedores----------------------------
     * Ver permisos de Alta
     */
    public function canAltaProv() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Prov/Alta')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos de Baja
     */
    public function canBajaProv() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Prov/Baja')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos para Modificar 
     */
    public function canModificarProv() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Prov/Modificar')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos para Consultar 
     */
    public function canConsultaProv() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Prov/Consultar')
        ->value('PathAuth');

        return $path != null ; 
    }



    /**---------------Permisos de Vincular Proveedores_Articulo----------------------------
     * Ver permisos para Vincular
     */
    public function canVincularProvAr() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/ProvAr/Vincular')
        ->value('PathAuth');

        return $path != null ; 
    }
    /*
     * Ver permisos para Desvincular
     */
    public function canDesvincularProvAr() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/ProvAr/Desvincular')
        ->value('PathAuth');

        return $path != null ; 
    }

    /*
     * Ver permisos para Consultar Vinculos
     */
    public function canConsultaProvAr() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/ProvAr/Consultar')
        ->value('PathAuth');

        return $path != null ; 
    }





    /**---------------Permisos de Solicitudes de Compra----------------------------
     * Ver permisos de Alta
     */
    public function canAltaSC() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SC/Alta')
        ->value('PathAuth');

        return $path != null ; 
    }

    /** * Ver permisos de Baja
     */
    public function canBajaSC() { 
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SC/Baja')
        ->value('PathAuth');

        return $path != null ; 
    }
    /**
     * Ver permisos para Modificar
     */
    public function canModificarSC() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SC/Modificar')
        ->value('PathAuth');
        return $path != null ; 
    }
/**
     * Ver permisos para Consultar
     */
    public function canConsultaSC() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SC/Consultar')
        ->value('PathAuth');
        return $path != null ; 
    }

    /**---------------Permisos de Solicitudes de Presupuestos----------------------------
     * Ver permisos de Alta
     */
    public function canAltaSP() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SP/Alta')
        ->value('PathAuth');
        return $path != null ; 
    }
    /**
     * * Ver permisos para Consultar
     */
    public function canConsultaSP() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/SP/Consultar')
        ->value('PathAuth');
        return $path != null ; 
    }
    /**---------------Permisos de Presupuestos----------------------------
     * Ver permisos de Alta
     */
    public function canAltaPres() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Pres/Alta')
        ->value('PathAuth');

        return $path != null ; 
    }

    /*** Ver permisos para Modificar
     */
    public function canModificarPres() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Pres/Modificar')
        ->value('PathAuth');
        return $path != null ; 
    }
    /**
     * Ver permisos para Consultar
     */
    public function canConsultaPres() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/Pres/Consultar')
        ->value('PathAuth');
        return $path != null ; 
    }
/**---------------Permisos de Ordenes de Compra---------------------------
     * Ver permisos de Alta
     */
    public function canAltaOC() {
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/OC/Alta')
        ->value('PathAuth');

        return $path != null ; 
    }
    /**
     * Ver permisos para Modificar
     */
    public function canModificarOC() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/OC/Modificar')
        ->value('PathAuth');
        return $path != null ; 
    }
/**
     * Ver permisos para Consultar
     */
    public function canConsultaOC() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/OC/Consultar')
        ->value('PathAuth');
        return $path != null ; 
    }

/**
     * Ver permisos de SuperUsuario
     */
    public function isSU() {
        
        $path=DB::table('usuarios_roles')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('usuarios_roles.RolID','Super_Usuario')
        ->value('RolID');
        return $path != null ; 
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
}
