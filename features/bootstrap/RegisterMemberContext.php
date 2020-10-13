<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\MemberRepository;
use App\Entity\Member;
use App\UseCase\RegisterMember;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Behat\Behat\Context\Context;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegisterMemberContext implements Context
{
    /**
     * @var RegisterMember
     */
    private RegisterMember $registerMember;

    /**
     * @var Member
     */
    private Member $member;

    /**
     * @Given /^I need to register to have a member account$/
     */
    public function iNeedToRegisterToHaveAMemberAccount()
    {
        $userPasswordEncoder = new class () implements UserPasswordEncoderInterface
        {
            /**
             * @inheritDoc
             */
            public function encodePassword(UserInterface $user, string $plainPassword)
            {
                return "hash_password";
            }

            public function isPasswordValid(UserInterface $user, string $raw)
            {
            }

            public function needsRehash(UserInterface $user): bool
            {
            }
        };

        $this->registerMember = new RegisterMember(new MemberRepository(), $userPasswordEncoder);
    }

    /**
     * @When /^I fill the member registration form$/
     */
    public function iFillTheMemberRegistrationForm()
    {
        $this->member = new Member();
        $this->member
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*");
    }

    /**
     * @Then /^I can log in with my member account$/
     * @throws AssertionFailedException
     */
    public function iCanLogInWithMyMemberAccount()
    {
        Assertion::eq($this->member, $this->registerMember->execute($this->member));
    }
}
