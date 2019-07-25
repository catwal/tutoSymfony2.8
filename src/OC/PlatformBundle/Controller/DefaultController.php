<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller

{

    public function indexAction()
    {
        $advert_id = 5;
        return $this->render('OCPlatformBundle:Default:index.html.twig', array(
            'advert_id'=>$advert_id,
        ));
    }
}
