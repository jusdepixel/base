<?php

namespace App\UseCase;

use App\Entity\Visitor;
use App\Gateway\VisitorGateway;
use Assert\Assert;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * RegisterVisitor constructor.
     * @param VisitorGateway $gateway
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(VisitorGateway $gateway, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->gateway = $gateway;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param Visitor $visitor
     * @return Visitor
     */
    public function execute(Visitor $visitor): Visitor
    {
        $pwPattern = "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/";

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
                ->regex($pwPattern)
            ->verifyNow()
        ;

        $visitor->setPassword($this->passwordEncoder->encodePassword($visitor, $visitor->getPlainPassword()));

        $this->gateway->register($visitor);

        return $visitor;
    }
}
