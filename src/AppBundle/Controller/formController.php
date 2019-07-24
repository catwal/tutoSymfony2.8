<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;

class formController extends Controller
{
    public function newAction(Request $request)

    {

        $task = new Task();
        $task->setTask('Write a blog Post');
        $task->setDueDate(new \DateTime('tomorrow'));
        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class)
            ->add('dueDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Create Task'))
            ->getForm();



        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $task = $form->getData();

          //  TODO : finish form tuto symfo 2.8
        }

        return $this->render('AppBundle:form:new.html.twig', array(
            'form' => $form->createView(),
        ));


    }
}
