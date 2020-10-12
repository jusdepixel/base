<?php

namespace App\Gateway;

use App\Entity\Admin;

/**
 * Interface AdminGateway
 * @package App\Gateway
 */
interface AdminGateway extends UserGateway
{
    /**
     * @param Admin $admin
     */
    public function register(Admin $admin): void;
}
