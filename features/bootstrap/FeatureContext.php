<?php
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class FeatureContext  extends MinkContext implements Context, SnippetAcceptingContext
{

    private $test;
    private $addform;
    public function __construct()
    {
        $this->test = new \AppBundle\Controller\TodoControler();
    }

    /**
     * @Given i am on :arg1
     */
    public function iAmOn($arg1)
    {
        //throw new PendingException();

    }

    /**
     * @When I fill the todowork with :arg1
     */
    public function iFillTheTodoworkWith($todowork)
    {
        //throw new PendingException();
        $newItem = $this->getRepository('AppBundle:TodoDatabase');
        //$product = $this->getRepository('AcmeDemoBundle:Product')->findOneByName($productName);
        //$category = $this->getRepository('AcmeDemoBundle:Category')->findOneByName($categoryName);

        $newItem->addAction($todowork);

        $this->getEntityManager()->persist($newItem);
        $this->getEntityManager()->flush();
    }

    /**
     * @When I press the :arg1 button
     */
    public function iPressTheButton($arg1)
    {
       // throw new PendingException();
    }

    /**
     * @Then page should redirect to :arg1
     */
    public function pageShouldRedirectTo($arg1)
    {
        //throw new PendingException();
    }





}
