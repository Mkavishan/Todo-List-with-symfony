<?php
require ("AppBundle/Controller/hello.php");
use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;

class FeatureContext extends BehatContext implements SnippetAcceptingContext
{
    private  $Adder;
    /**
     * @Given I have the number :arg1 and the number :arg2
     */
    public function iHaveTheNumberAndTheNumber($a, $b)
    {
        $this->Adder = new \AppBundle\Controller\hello($a,$b);
        //throw new PendingException();
    }

    /**
     * @When I add the togrther
     */
    public function iAddTheTogrther()
    {
        $this->Adder->add();
       // throw new PendingException();
    }

    /**
     * @Then I should get :arg1
     */
    public function iShouldGet($sum)
    {
        if($this->Adder->sum != $sum){
            throw new Exception("Actual sum : ".$this->Adder->sum);
        }
        $this->Adder->display();
        //throw new PendingException();
    }

}
