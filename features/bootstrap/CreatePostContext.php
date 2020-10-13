<?php

namespace App\Features;

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;

/**
 * Class CreatePostContext
 * @package App\Features
 */
class CreatePostContext implements Context
{
    /**
     * @Given /^I want to create a post$/
     */
    public function iWantToCreateAPost()
    {
        throw new PendingException();
    }

    /**
     * @When /^I fill my post form$/
     */
    public function iFillMyPostForm()
    {
        throw new PendingException();
    }

    /**
     * @Then /^My post is online$/
     */
    public function myPostIsOnline()
    {
        throw new PendingException();
    }
}
