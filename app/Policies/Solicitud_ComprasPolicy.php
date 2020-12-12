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
class Solicitud_ComprasPolicy {

    /**
     * Determina si un usuario puede crear una solicitud de compras, devolviendo true o false en el método.
     * En este caso, se invoca una función sobre el usuario para verificar si posee el rol "admin"
     */
    public function create(User $user) {
        return $user->canAltaSC();
    }


    /**
     * Determina si un usuario puede actualizar la solcitud. Dado que esta ya existe, el método la recibe como parámetro
     * en caso que, por ejemplo, un usuario solo pueda actualizar una solicitud que él creó. Si fuese así, podemos veri-
     * ficar si coincide el usuario con el que posee la solicitud.
     * @param User $user
     * @param Solicitud_Compras $solicitud
     * @return mixed
     */
    public function update(User $user, Solicitud_Compras $solicitud) {
//        return $user->isAdmin() && $solicitud->user == $user;
        return $user->isAdminCompras();
    }


}
