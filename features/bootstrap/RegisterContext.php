<?php

namespace App\Features;

use Behat\Behat\Context\Context;

class RegisterContext implements Context
{
    /**
     * @Given /^I need to register to have an account$/
     */
    public function iNeedToRegisterToHaveAnAccount()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I fill the registration form$/
     */
    public function iFillTheRegistrationForm()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^I can log in with my account$/
     */
    public function iCanLogInWithMyAccount()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
