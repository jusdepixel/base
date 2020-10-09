<?php

namespace App\UseCase;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;
use Assert\Assert;

class RegisterVisitor
{
    /**
     * @var VisitorGateway
     */
    private VisitorGateway $gateway;

    /**
     * RegisterVisitor constructor.
     * @param VisitorGateway $gateway
     */
    public function __construct(VisitorGateway $gateway)
    {
        $this->gateway = $gateway;
    }

    /**
     * @param Visitor $visitor
     * @return Visitor
     */
    public function execute(Visitor $visitor): Visitor
    {
        Assert::lazy()
            ->that($visitor->getFirstName(), 'firstName')
                ->notBlank()
                ->minLength(2)
            ->that($visitor->getLastName(), 'lastName')
                ->notBlank()
                ->minLength(2)
            ->that($visitor->getEmail(), 'email')
                ->notBlank()
                ->email()
            ->that($visitor->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->regex(
                    "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
                )
            ->verifyNow()
        ;

        $this->gateway->register($visitor);

        return $visitor;
    }
}