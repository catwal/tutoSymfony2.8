<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class flashMessageController extends Controller
{
    /**
     * @Route("/update")
     */
    public function updateAction(Request $request)
    {
        $form = false;
        // if ($form->isSubmitted() && $form->isValid()) {
        if (!$form) {
            // do some sort of processing

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );
            return $this->render('AppBundle:flashMessage:update.html.twig', array(// ...
            ));
        }

    }
}
