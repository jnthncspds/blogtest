<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Test;
use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }

    /**
    *@Route("/test", name="prueba")
    *
    */

    public function nombreAction(){

      $test = $this->getDoctrine()
      ->getRepository('AppBundle:Tests')
      ->findAll();

      return $this->render('default/prueba.html.twig', array(
        'test' => $test
      ));
    }
    /**
    *@Route("/test/edit", name="prueba_edit")
    *
    */

    public function editAction(){
      return $this->render('default/edit.html.twig');
    }
    /**
    *@Route("/test/create", name="prueba_create")
    *
    */

    public function createAction(){
      return $this->render('default/create.html.twig');
    }

    /**
    *@Route("/test/details", name="prueba_details")
    *
    */

    public function detailsAction(){
      return $this->render('default/details.html.twig');
    }
}
