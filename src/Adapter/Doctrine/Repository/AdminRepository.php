<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Admin;
use App\Gateway\AdminGateway;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class AdminRepository
 * @package App\Adapter\Doctrine\Repository
 * @method Admin|null find($id, $lockMode = null, $lockVersion = null)
 * @method Admin|null findOneBy(array $criteria, array $orderBy = null)
 * @method Admin[]    findAll()
 * @method Admin[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdminRepository extends UserRepository implements AdminGateway
{
    /**
     * AdminRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Admin::class);
    }

    /**
     * @param Admin $admin
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function register(Admin $admin): void
    {
        $this->_em->persist($admin);
        $this->_em->flush();
    }
}
