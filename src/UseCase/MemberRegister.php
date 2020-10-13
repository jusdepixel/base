<?php

namespace App\UseCase;

use App\Entity\Member;
use App\Gateway\MemberGateway;
use Assert\Assert;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class RegisterMember
 * @package App\UseCase
 */
class MemberRegister
{
    /**
     * @var MemberGateway
     */
    private MemberGateway $gateway;

    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    /**
     * RegisterMember constructor.
     * @param MemberGateway $gateway
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(MemberGateway $gateway, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->gateway = $gateway;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @param Member $member
     * @return Member
     */
    public function execute(Member $member): Member
    {
        $pwPattern = "/^(?:(?=.*[a-z])(?:(?=.*[A-Z])(?=.*[\d\W])|(?=.*\W)(?=.*\d))|(?=.*\W)(?=.*[A-Z])(?=.*\d)).{8,}$/";

        Assert::lazy()
            ->that($member->getFirstName(), 'firstName')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($member->getLastName(), 'lastName')
                ->notBlank()
                ->minLength(2)
                ->maxLength(255)
            ->that($member->getEmail(), 'email')
                ->notBlank()
                ->maxLength(255)
                ->email()
            ->that($member->getPlainPassword(), 'plainPassword')
                ->notBlank()
                ->maxLength(255)
                ->regex($pwPattern)
            ->verifyNow()
        ;

        $member->setPassword($this->passwordEncoder->encodePassword($member, $member->getPlainPassword()));

        $this->gateway->register($member);

        return $member;
    }
}
