<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class sessionController extends Controller
{
    /**
     * @Route("/request")
     */
    public function requestAction(Request $request)
    {
        $page =$request->query->get('page', 1);
        return $this->render('AppBundle:session:request.html.twig', array(
            // ...
        ));
        // need a response
    }

    /**
     * @Route ("/session")
     */
    public function sessionAction(Request $request)
    {
       $session = $request->getSession();

    // stores an attribute for reuse during a later user request
    $session->set('foo', 'bar');
        dump($session);
    // gets the attribute set by another controller in another request
    $foobar = $session->get('foobar');

    // uses a default value if the attribute doesn't exist
    $filters = $session->get('filters', array());

        return $this->render('AppBundle:session:request.html.twig', array(
            // ...
        ));

    }


}
