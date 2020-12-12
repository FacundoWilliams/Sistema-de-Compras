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

    /**
     * Método agregado para ejemplo permisos y roles
     */
    public function isAdminCompras() {
        return $this->RolID == '1';
    }

    /**
     * Método agregado para ejemplo permisos y roles
     */
    public function canAltaSC() {
        
        $path=DB::table('usuarios_roles')
        ->join('roles_permisos','usuarios_roles.RolID','=','roles_permisos.RolID')
        ->join('permisos','permisos.PermisoID','=','roles_permisos.PermisoID')
        ->where('usuarios_roles.UsuarioID',$this->id)
        ->where('permisos.PathAuth','/solicitudesCompras/Alta')
        ->value('PathAuth');

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
