<?php

namespace App\Features;

use App\Adapter\InMemory\Repository\AdminRepository;
use App\Entity\Admin;
use App\UseCase\RegisterAdmin;
use Assert\Assertion;
use Assert\AssertionFailedException;
use Behat\Behat\Context\Context;

class RegisterAdminContext implements Context
{
    /**
     * @var Admin
     */
    private Admin $admin;

    /**
     * @var RegisterAdmin
     */
    private RegisterAdmin $registerAdmin;

    /**
     * @Given /^I need to register to have an admin account$/
     */
    public function iNeedToRegisterToHaveAnAdminAccount()
    {
        $this->registerAdmin = new RegisterAdmin(new AdminRepository());
    }

    /**
     * @When /^I fill the admin registration form$/
     */
    public function iFillTheAdminRegistrationForm()
    {
        $this->admin = new Admin();
        $this->admin
            ->setFirstName("John")
            ->setLastName("Doe")
            ->setEmail("john@doe.com")
            ->setPlainPassword("Password123*")
            ->setPseudo("JooohnDoooe");
    }

    /**
     * @Then /^I can log in with my admin account$/
     * @throws AssertionFailedException
     */
    public function iCanLogInWithMyAdminAccount()
    {
        Assertion::eq($this->admin, $this->registerAdmin->execute($this->admin));
    }
}
