<?php

namespace App\Gateway;

use App\Entity\Admin;

interface AdminGateway extends UserGateway
{
    public function register(Admin $admin): void;

}