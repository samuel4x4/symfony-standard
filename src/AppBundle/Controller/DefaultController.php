<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class DefaultController extends Controller
{
    /**
     * @Route("/task", name="task")
     * @Template()
     */
    public function newAction(Request $request)
    {
        // just setup a fresh $task object (remove the dummy data)
        $task = new Task();
    
        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            dump($task);
            dump($request);
            exit;
            return $this->redirectToRoute('task_success');
        }
    
        return ['form' => $form->createView()];
    }  
    
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->redirectToRoute($route);
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
    
}
