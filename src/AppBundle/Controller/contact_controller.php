<?php
/**
 * Created by PhpStorm.
 * User: miyuru
 * Date: 9/12/16
 * Time: 9:48 AM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Database;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class contact_controller extends Controller
{
    /**
     * @Route("/list", name="contact_list")
     */
    public function listAction(){
        return $this -> render('contact/view_contact.html.twig');
    }

    /**
     * @Route("/contact/new")
     */
    public function newAction(){
        $database = new Database();
        $database -> setName('Miyuru');
        $database -> setTel('0716179152');
        $database -> setAddress('Nugegoda');
        $database -> setEmail('Miy@gmail.com');

        $em = $this-> getDoctrine()->getManager();
        $em -> persist($database);
        $em -> flush();

        return new Response('<html><body>OK</body> </html>');
    }
    public function viewDetails(){
        $db = new Database();

    }
}