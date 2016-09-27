<?php
use Behat\Behat\Context\Context;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\SnippetAcceptingContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use GuzzleHttp\Client;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

class FeatureContext  extends MinkContext implements Context, SnippetAcceptingContext
{
    public $_response;
    public $_client;
    private $_parameters = array();
    private $newTodo;

    public function __construct(array $parameters)
    {
        $this->_parameters = $parameters;
        $baseUrl = $this->getParameter('base_url');
        $client = new Client(['base_url' => $baseUrl]);
        $this->_client = $client;
        $this->newTodo = new \AppBundle\Controller\TodoControler();
    }
    /**
     * @Given i am on :arg1
     */
    public function iAmOn($url)
    {
        $request = $this->_client->get($url);
        $this->_response = $request;
    }

    /**
     * @When I fill the todowork with :arg1 priority :arg2
     */
    public function iFillTheTodoworkWithPriority($todowork, $priority)
    {
        $arr = array('todowork ' => $todowork, 'priority' => $priority);
        $list = json_encode($arr);
        $request = Request::create(
           '/add2',
            'POST',
           array($list)
        );
        $this->newTodo->addAction($request);
    }

    /**
     * @When get the item on todo list
     */
    public function getTheItemOnTodoList()
    {
        $request = $this->_client->get("http://127.0.0.1:8000/todo/list");
        $this->_response = $request;
        $data = json_decode($this->_response->getBody(true));
        if (empty($data)) { throw new Exception("Response was not JSON\n" . $this->_response);
        }

    }

    /**
     * @Then there should be in :arg1 equals : arg2
     */
    public function thereShouldBeIn($property , $todowork)
    {
        $request = $this->_client->get("http://127.0.0.1:8000/todo/list");
        $this->_response = $request;
        $data = json_decode($this->_response->getBody(true));

        if (!empty($data)) {
            if (!isset($data->$property)) {
                throw new Exception("Property '".$property."' is not set!\n");
            }
            if ($data->$property !== $todowork) {
                throw new \Exception('Property value mismatch! (given: '.$todowork.', match: '.$data->$property.')');
            }
        } else {
            throw new Exception("Response was not JSON\n" . $this->_response->getBody(true));
        }

    }


}
