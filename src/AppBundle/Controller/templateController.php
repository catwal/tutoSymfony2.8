<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class templateController extends Controller
{
    /**
     * route into routing.yml
     * ("/displayTwig")
     */
    public function displayTwigAction()
    {
        $blog_entries = array('foo', 'test', 'bar', 'again');

        return $this->render('AppBundle:template:display_twig.html.twig', array(
            'blog_entries'=> $blog_entries,
        ));
    }

}
