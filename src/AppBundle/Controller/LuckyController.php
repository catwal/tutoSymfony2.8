<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

// use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     *
     * @Route("/lucky/number/{max}")
     */
    public function numberAction($max)
    {
        $number = random_int(0, $max);

//        return new Response(
//            '<html><body> Lucky number: ' .$number. '</body></html>'
//        );

        // render => call page twig with parameters number
        return $this->render('AppBundle:Lucky:number.html.twig', array(
            'number' => $number,
        ));
    }

    /**
     *
     * @Route("/error")
     */
    public function errorAction()
    {
        $product = false;
        if(!$product){
            throw $this->createNotFoundException('Product does not exist');

        }
        return $this->render('AppBundle:Lucky:number.html.twig', array(
        ));

    }

    // throw exception 500 HTTP status code
    /**
     * @Route("/error/exception")
     */
    public function errorExceptionAction()
    {
        $product = false;
        if(!$product){
            throw new \Exception('Something went wrong!');
        }
        return $this->render('AppBundle:Lucky:number.html.twig', array(
        ));
    }

    // method for redirecting user to specific url
    public function indexAction()
    {
        // redirects to the "homepage" route
        return $this->redirectToRoute('homepage');

        // does a permanent - 301 redirect
        return $this->redirectToRoute('homepage', array(), 301);

        // redirects to a route with parameters
        return $this->redirectToRoute('blog_show', array('slug' => 'my-page'));

        // redirects to a route and mantains the original query string parameters
        return $this->redirectToRoute('blog_show', $request->query->all());

        // redirects externally
        return $this->redirect('http://symfony.com/doc');

        // redirects by using RedirectResponse
        return new RedirectResponse($this->generateUrl('homepage'));
    }



    // declarations of services:
    public function servicesAction ()
    {
        $templating = $this->get('templating');
        $router = $this->get('router');
        $mailer = $this->get('mailer');

        // indication of container configuration parameter use getParameter
        // for deeper configuration
        $from = $this->getParameter('app.mailer.from');

    }
}
