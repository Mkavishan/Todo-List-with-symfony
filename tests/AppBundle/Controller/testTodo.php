<?php
namespace tests\AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
class todoTest extends WebTestCase{
    //Test List item
    public function testListitem (){
       // $todoTest = new \AppBundle\Controller\TodoControler();
        $client = static::createClient();

        $crawler = $client->request('GET', 'http://127.0.0.1:8000/todo/index');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        //$this->assertNotEmpty($todoTest->getResponse()->getContent());
        //$this->assertEquals($expected,$crawler);
        //$this->assertEquals($expected,$todoTest->listAction());

    }
    /*
    public function testAddItem(){
        $client = static::createClient();
        $crawler = $client->request('POST','http://127.0.0.1:8000/todo/add');
        $this->assertEquals(200,$client->getResponse()->getStatusCode());
    }*/
    public function testAddItem(){
        echo "Miyuru Kavishan";
    }

}