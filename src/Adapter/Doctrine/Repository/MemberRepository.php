<?php

namespace App\Adapter\Doctrine\Repository;

use App\Entity\Member;
use App\Gateway\MemberGateway;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class MemberRepository
 * @package App\Adapter\Doctrine\Repository
 * @method Member|null find($id, $lockMode = null, $lockVersion = null)
 * @method Member|null findOneBy(array $criteria, array $orderBy = null)
 * @method Member[]    findAll()
 * @method Member[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MemberRepository extends UserRepository implements MemberGateway
{
    /**
     * MemberRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Member::class);
    }

    /**
     * @param Member $member
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function register(Member $member): void
    {
        $this->_em->persist($member);
        $this->_em->flush();
    }

    /**
     * @param Member $member
     */
    public function updateResume(Member $member): void
    {
        // TODO: Implement updateResume() method.
    }
}
