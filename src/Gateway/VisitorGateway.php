<?php

namespace App\Gateway;

use App\Entity\Visitor;

/**
 * Interface VisitorGateway
 * @package App\Gateway
 */
interface VisitorGateway extends UserGateway
{
    /**
     * @param Visitor $visitor
     */
    public function register(Visitor $visitor): void;
}
