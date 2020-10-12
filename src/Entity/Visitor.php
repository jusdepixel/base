<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Visitor
 * @package App\Entity
 * @ORM\Entity
 */
class Visitor extends User
{
    /**
     * @return string[]
     */
    public function getRoles()
    {
        return ["ROLE_USER", 'ROLE_VISITOR'];
    }
}
