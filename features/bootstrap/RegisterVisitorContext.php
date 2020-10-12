<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\VisitorRepository;
use App\Entity\Visitor;
use App\UseCase\RegisterVisitor;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Behat\Behat\Context\Context;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class RegisterVisitorContext implements Context
{
    /**
     * @var RegisterVisitor
     */
    private RegisterVisitor $registerVisitor;

    /**
     * @var Visitor
     */
    private Visitor $visitor;

    /**
     * @Given /^I need to register to have a visitor account$/
     */
    public function iNeedToRegisterToHaveAVisitorAccount()
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

        $this->registerVisitor = new RegisterVisitor(new VisitorRepository(), $userPasswordEncoder);
    }

    /**
     * @When /^I fill the visitor registration form$/
     */
    public function iFillTheVisitorRegistrationForm()
    {
        $this->visitor = new Visitor();
        $this->visitor
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*");
    }

    /**
     * @Then /^I can log in with my visitor account$/
     * @throws AssertionFailedException
     */
    public function iCanLogInWithMyVisitorAccount()
    {
        Assertion::eq($this->visitor, $this->registerVisitor->execute($this->visitor));
    }
}
