<?php

namespace App\Entity;

class Visitor extends User
{
    public function getRoles()
    {
        return ["ROLE_USER", 'ROLE_VISITOR'];
    }
}
