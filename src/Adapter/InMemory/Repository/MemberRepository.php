<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Member;
use App\Gateway\MemberGateway;

/**
 * Class MemberRepository
 * @package App\Adapter\InMemory\Repository
 */
class MemberRepository implements MemberGateway
{

    /**
     * @param Member $member
     */
    public function register(Member $member): void
    {
    }
}
