<?php

namespace App\Features;

use Behat\Behat\Context\Context;

class CreatePostContext implements Context
{
    /**
     * @Given /^I want to create a post$/
     */
    public function iWantToCreateAPost()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @When /^I fill my post form$/
     */
    public function iFillMyPostForm()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }

    /**
     * @Then /^My post is online$/
     */
    public function myPostIsOnline()
    {
        throw new \Behat\Behat\Tester\Exception\PendingException();
    }
}
