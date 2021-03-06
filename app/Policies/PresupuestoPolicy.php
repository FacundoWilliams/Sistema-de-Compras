<?php

namespace App\Policies;

use App\Models\Solicitud_Compras;
use App\Models\User;

/**
 * Una de las maneras de agregar autorización a una acción en Laravel es mediante <strong>Policies</strong>.
 * Esta policy será encontrada automáticamente por el framework, dado que implementa la
 * naming convention "<nombre_model>Policy". También es posible registrarla de forma explícita en el service provider
 * como se indica en la doc: https://laravel.com/docs/8.x/authorization#registering-policies
 */
class PresupuestoPolicy {

    /**
     * Determina si un usuario puede crear una solicitud de compras, devolviendo true o false en el método.
     * En este caso, se invoca una función sobre el usuario para verificar si posee el rol "admin"
     */
    public function alta(User $user) {
        return $user->canAltaPres();
    }


    public function modificar(User $user) {
        return $user->canModificarPres();
    }

    public function consultar(User $user) {
        return $user->canConsultaPres();
    }


}
