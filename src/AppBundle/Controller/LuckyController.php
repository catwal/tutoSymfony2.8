<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
// use Symfony\Component\HttpFoundation\Response;

class LuckyController extends Controller
{
    /**
     * @Route("/lucky/number")
     */
    public function numberAction()
    {
        $number = random_int(0, 100);

//        return new Response(
//            '<html><body> Lucky number: ' .$number. '</body></html>'
//        );

        return $this->render('AppBundle:Lucky:number.html.twig', array(
            'number' => $number,
        ));
    }

}
