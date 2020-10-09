<?php

namespace App\Entity;

/**
 * Class Visitor
 * @package App\Entity
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
