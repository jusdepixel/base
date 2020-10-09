<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Admin;
use App\Gateway\AdminGateway;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends UserRepository implements AdminGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admin::class);
    }

    public function register(Admin $admin): void
    {
        // TODO: Implement register() method.
    }
}
