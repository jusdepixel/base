<?php

namespace App\Gateway;

use App\Entity\Visitor;

interface VisitorGateway extends UserGateway
{
    public function register(Visitor $visitor): void;
}
