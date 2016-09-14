<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class hello extends Controller
{
    /**
     * @Route("/hello/{myName}")
     */
    public  function  showAction($myName){
        //return new Response('Hello World'.$myName);

        $notes = [
            'Octopus asked me a riddle, outsmarted me',
            'I counted 8 legs... as they wrapped around me',
            'Inked!'
        ];
        $templating = $this->container->get('templating');
        return $this->render('contact/show.html.twig',['name'=> $myName, 'notes' => $notes]);
        //$html = $templating->render('contact/show.html.twig',array(
        //'name' => $myName
       // ));
        return new Response($html);
    }


}