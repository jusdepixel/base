<?php

namespace App\Gateway;

use App\Entity\Member;

/**
 * Interface MemberGateway
 * @package App\Gateway
 */
interface MemberGateway extends UserGateway
{
    /**
     * @param Member $member
     */
    public function register(Member $member): void;

    /**
     * @param Member $member
     */
    public function updateResume(Member $member): void;
}
