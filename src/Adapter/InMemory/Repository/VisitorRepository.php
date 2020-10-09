<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;

class VisitorRepository implements VisitorGateway
{

    public function register(Visitor $visitor): void
    {
        // TODO: Implement register() method.
    }
}
