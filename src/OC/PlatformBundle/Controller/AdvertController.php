<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {

//        return new Response("Hello-World in page index");
        return $this->render('OCPlatformBundle:Advert:index.html.twig', array(
            // ...
        ));
    }

}
