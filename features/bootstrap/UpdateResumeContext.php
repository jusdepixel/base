<?php

namespace App\Features;

use Behat\Behat\Context\Context;

class UpdateResumeContext implements Context
{
    /**
     * @Given /^I want to update my resume$/
     */
    public function iWantToUpdateMyResume()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I fill my resume form$/
     */
    public function iFillMyResumeForm()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^I have a full resume$/
     */
    public function iHaveAFullResume()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
