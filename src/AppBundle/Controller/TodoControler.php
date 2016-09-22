<?php
/**
 * Created by PhpStorm.
 * User: miyuru
 * Date: 9/8/16
 * Time: 4:02 PM
 */

namespace AppBundle\Controller;

use AppBundle\Entity\TodoDatabase;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;
use JMS\SerializerBundle\Serializer\Serializer;

class TodoControler extends Controller
{
    public function num(){
        //echo 'Kavishan';
        return 20;
    }

    /**
     * @Route("todo/list", name="todo_list")
     * @Method("GET")
     */
    public function listAction(){
        /*
        $todos = $this-> getDoctrine()
            -> getRepository('AppBundle:TodoDatabase')
            ->findAll();


        return $this -> render('todo/index.html.twig', array(
            'todos' => $todos
        ));
        */

        //$database = new TodoDatabase();
        $em = $this->getDoctrine()->getManager();
        $todos = $em->getRepository('AppBundle:TodoDatabase')->findAll();
        $todos = $this->get('serializer')->serialize($todos,'json');
        $respose = new Response($todos);
        $respose->headers->set('Content-Type','application/json');
        return $respose;

    }

    /**
     * @Route("todo/index", name="display")
     */
    public function display(){
        return $this -> render('todo/index.html.twig');
    }

    /**
     * @Route("todo/done", name="done_works")
     */
    public function doneWork(){
        return $this -> render('todo/doneworks.html.twig');
    }

    /**
     * @Route("todo/add", name="form")
     */
    public function form(){
        return $this -> render('todo/add2.html.twig');
    }

    /**
     * @Route("todo/add2")
     * @Method("POST")
     */
    public function addAction(Request $request){
    /*
        $todo = new TodoDatabase();
        $form = $this ->createFormBuilder($todo)
            ->add('todowork', TextType::class, array('attr'=> array('class'=> 'form-control', 'style'=>'margin-bottom:15px')))
            ->add('save', SubmitType::class, array('label'=>'Add ToDo','attr'=> array('class'=> 'btn btn-primary', 'style'=>'margin-bottom:15px')))
            ->getForm();
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            //die('Submited');
            $todowork = $form['todowork']->getData();


            $todo -> setTodowork($todowork);
            $todo -> setStatus(0);

            $em = $this->getDoctrine()->getManager();
            $em -> persist($todo);
            $em -> flush();

            $this -> addFlash(
                'notice','Todo Added'
            );
            return $this-> redirectToRoute('todo_list');

        }
        return $this -> render('todo/add.html.twig', array('form'=> $form->createView()));


        return $this -> render('todo/add2.html.twig');
    */

            $data = json_decode($request->getContent(), true);
            $todo = new TodoDatabase();

            $todowork = $data['todoText'];
            $priority = $data['priority'];
            $todo->setTodowork($todowork);
            $todo->setPriority($priority);
            $todo->setStatus(0);

            $em = $this-> getDoctrine()->getManager();
            $em->persist($todo);
            $em->flush();
            $this->addFlash(
                'Notice',
                'todo Added'
            );
        return $this-> redirectToRoute('done_works');



    }

    /**
     * @Route("todo/detail/{id}", name="todo_detail")
     */
    public function detailAction($id ,Request $request){
        return $this -> render('todo/detail.html.twig');
    }

    /**
     * @Route("todo/edit/{id}", name="todo_edit")
     */
    public function editAction($id){
        return $this -> render('todo/edit.html.twig');
    }

    /**
     * @Route("todo/delete/{id}", name="todo_delete")
     */
    public function deleteAction($id){
        $em = $this-> getDoctrine()->getManager();
        $todo = $em-> getRepository('AppBundle:TodoDatabase')->find($id);
        $em-> remove($todo);
        $em->flush();
        $this-> addFlash('noticed','Todo Removed');
        return $this-> redirectToRoute('display');
    }

    /**
     * @Route("/todo/new")
     */
    public function newAction(){
        $database = new TodoDatabase();
        $database -> setTodowork('To Learn PHP');
        $database -> setStatus(1);


        $em = $this-> getDoctrine()->getManager();
        $em -> persist($database);
        $em -> flush();

        return new Response('<html><body>OK</body> </html>');
    }

    /**
     * @Route("todo/update")
     * @Method("POST")
     */
    public function changeStatus(Request $request){
        $data = json_decode($request->getContent(), true);
       // $todo = new TodoDatabase();

        $id = $data["id"];

        //$todo->setTodowork("Learn");
        //$todo->setStatus(1);

        $em = $this-> getDoctrine()->getManager();
        $todoid = $em->getRepository('AppBundle:TodoDatabase')->find($id);
        if(!$todoid){
            throw $this->createNotFoundException(
                'No todo find'
            );
        }
        $todoid->setStatus(1);
        $em->flush();
        return $this-> redirectToRoute('display');

    }
    /**
     * @Route("todo/undoneList", name="undone_list")
     * @Method("GET")
     */
    public function undonelist(){
        $repository= $this->getDoctrine()->getRepository('AppBundle:TodoDatabase');
        $query = $repository->createQueryBuilder('t')
            ->select('t.status,t.todowork,t.id, t.priority')
            ->Where('t.status = 0')
            ->OrderBy ('t.priority','DESC')
            ->getQuery();
        $entities = $query->getResult();

        $todos = $this->get('serializer')->serialize($entities,'json');
        $respose = new Response($todos);
        $respose->headers->set('Content-Type','application/json');
        return $respose;

    }
    /**
     * @Route("todo/doneList", name="done_list")
     * @Method("GET")
     */
    public function donelist(){
        $repository= $this->getDoctrine()->getRepository('AppBundle:TodoDatabase');
        $query = $repository->createQueryBuilder('t')
            ->select('t.status,t.todowork,t.id,t.priority')
            ->Where('t.status = 1')
            ->OrderBy ('t.priority','DESC')
            ->getQuery();
        $entities = $query->getResult();

        $todos = $this->get('serializer')->serialize($entities,'json');
        $respose = new Response($todos);
        $respose->headers->set('Content-Type','application/json');
        return $respose;

    }


}