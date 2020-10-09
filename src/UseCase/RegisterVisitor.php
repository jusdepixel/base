<?php

namespace App\UseCase;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;
use Assert\Assert;

/**
 * Class RegisterVisitor
 * @package App\UseCase
 */
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
                ->maxLength(255)
            ->that($visitor->getLastName(), 'lastName')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($visitor->getEmail(), 'email')
                ->notBlank()
                ->maxLength(255)
                ->email()
            ->that($visitor->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->maxLength(255)
                ->regex(
                    "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/"
                )
            ->verifyNow()
        ;

        $this->gateway->register($visitor);

        return $visitor;
    }
}
