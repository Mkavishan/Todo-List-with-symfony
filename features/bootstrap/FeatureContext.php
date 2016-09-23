<?php

use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class FeatureContext implements SnippetAcceptingContext
{
    /**
     * Initializes context.
     */
    public function __construct()
    {

    }

    /**
     * @Given First i goto the :arg1
     */
    public function firstIGotoThe($arg1)
    {
        echo "Hello World\n";
        echo "Iam behat test\n";
        throw new PendingException();
    }

    /**
     * @Given I fill the  :arg1
     */
    public function iFillThe($arg1)
    {

        throw new PendingException();
    }

    /**
     * @Given I fill in :arg1 with :arg2
     */
    public function iFillInWith($arg1, $arg2)
    {

        throw new PendingException();
    }

    /**
     * @Given I press :arg1
     */
    public function iPress($arg1)
    {

        throw new PendingException();
    }

    /**
     * @Then I should see :arg1
     */
    public function iShouldSee($arg1)
    {

        throw new PendingException();
    }

}
