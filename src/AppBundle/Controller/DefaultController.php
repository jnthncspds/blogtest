<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tests;
use AppBundle\Entity\Post;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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

    public function createAction(Request $request){
      $tests = new Tests();

      $form = $this->CreateFormBuilder($tests)
      ->add('name', TextType::class, array('attr'=> array('class'=> 'form-control', 'style'=> 'margin-bottom:15px')))
      ->add('description', TextareaType::class, array('attr'=>array('class'=>'form-control', 'style'=>'margin-bottom:15px')))
      ->add('date', DateTimeType::class, array('attr'=>array('class'=>'formcontrol', 'style'=>'margin-bottom:15px')))
      ->add('save', SubmitType::class, array('attr'=>array('class'=>'btn btn-primary')))
      ->getForm();

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        # code...
        $name = $form['name']->getData();
        $description = $form['description']->getData();
        $date = $form['date']->getData();

        $tests->setName($name);
        $tests->setDescription($description);
        $tests->setDate($date);

        $em = $this->getDoctrine()->getManager();

        $em->persist($tests);
        $em->flush();

        $this->addFlash(
          'notice', 'Actividad Creada'
        );

        return $this->redirectToRoute('prueba');

      }


      return $this->render('default/create.html.twig', array(
        'form' => $form-> createView(),
      ));
    }

    /**
    *@Route("/test/details", name="prueba_details")
    *
    */

    public function detailsAction(){
      return $this->render('default/details.html.twig');
    }
}
