<?php

namespace App\Adapter\InMemory\Repository;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;

/**
 * Class VisitorRepository
 * @package App\Adapter\InMemory\Repository
 */
class VisitorRepository implements VisitorGateway
{

    /**
     * @param Visitor $visitor
     */
    public function register(Visitor $visitor): void {}
}
