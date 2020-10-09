<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Admin;
use App\Gateway\AdminGateway;

class AdminRepository implements AdminGateway
{

    public function register(Admin $admin): void
    {
        // TODO: Implement register() method.
    }
}
