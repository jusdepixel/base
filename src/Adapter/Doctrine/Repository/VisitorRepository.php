<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class VisitorRepository
 * @package App\Adapter\Doctrine\Repository
 * @method Visitor|null find($id, $lockMode = null, $lockVersion = null)
 * @method Visitor|null findOneBy(array $criteria, array $orderBy = null)
 * @method Visitor[]    findAll()
 * @method Visitor[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VisitorRepository extends UserRepository implements VisitorGateway
{
    /**
     * VisitorRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visitor::class);
    }

    /**
     * @param Visitor $visitor
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function register(Visitor $visitor): void
    {
        $this->_em->persist($visitor);
        $this->_em->flush();
    }
}
