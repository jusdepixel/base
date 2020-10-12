<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Member
 * @package App\Entity
 * @ORM\Entity
 */
class Member extends User
{
    /**
     * @return string[]
     */
    public function getRoles()
    {
        return ["ROLE_USER", 'ROLE_MEMBER'];
    }
}
