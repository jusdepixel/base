<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class VisitorRepository
 * @package App\Adapter\Doctrine\Repository
 * @method Visitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visitor[]    findAll()
 * @method Visitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorRepository extends ServiceEntityRepository implements VisitorGateway
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visitor::class);
    }

    public function register(Visitor $visitor): void
    {
        // TODO: Implement register() method.
    }
}
