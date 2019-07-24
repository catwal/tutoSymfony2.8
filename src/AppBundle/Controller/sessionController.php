<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    /**
     * @Route ("/requestObject")
     */
    public function objectRequestAction(Request $request)
    {
        $request->isXmlHttpRequest(); // is it an Ajax request?

        $request->getPreferredLanguage(array('en', 'fr'));

        // retrieves GET and POST variables respectively
        $request->query->get('page');
        $request->request->get('page');

        // retrieves SERVER variables
        $request->server->get('HTTP_HOST');

        // retrieves an instance of UploadedFile identified by foo
        $request->files->get('foo');

        // retrieves a COOKIE value
        $request->cookies->get('PHPSESSID');

        // retrieves an HTTP request header, with normalized, lowercase keys
        $request->headers->get('host');
        $request->headers->get('content-type');
        dump($request);

        return $this->render('AppBundle:session:request.html.twig', array(
            // ...
        ));


        // need a proper response
        $name = 'you';
        // creates a simple Response with a 200 status code (the default)
        $response = new Response('Hello '.$name, Response::HTTP_OK);

        // JsonResponse is a sub-class of Response
        $response = new JsonResponse(array('name' => $name));

        // sets a header!
        $response->headers->set('X-Rate-Limit', 10);
    }
}
