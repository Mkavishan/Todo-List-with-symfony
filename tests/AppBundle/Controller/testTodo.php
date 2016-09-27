<?php
namespace tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class todoTest extends WebTestCase{
    //Test List item
    public function testListitem (){

        $client = static::createClient();

        $crawler = $client->request('GET', 'http://127.0.0.1:8000/todo/index');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }
    public function addForm (){

        $client = static::createClient();

        $crawler = $client->request('GET', 'http://127.0.0.1:8000/todo/add');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

    public function doneworks (){

        $client = static::createClient();

        $crawler = $client->request('GET', 'http://127.0.0.1:8000/todo/done');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

    }

}