<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Admin;
use App\Gateway\AdminGateway;

/**
 * Class AdminRepository
 * @package App\Adapter\InMemory\Repository
 */
class AdminRepository implements AdminGateway
{

    /**
     * @param Admin $admin
     */
    public function register(Admin $admin): void {}
}
