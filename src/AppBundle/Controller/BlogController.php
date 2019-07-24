<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class BlogController extends Controller
{

    /**
     * Matches /blog exactly
     *
     * @Route("/blog", name="blog_list")
     */
    public function listAction()
    {
        return $this->render('AppBundle:Blog:list.html.twig', array(
            // ...
        ));
    }

    /**
     * Matches /blog/page
     *
     * @Route ("/blog/{page}", name="blog_list_pages", requirements={"page"="\d+"})
     */
    public function listedPageAction($page)
        // $page can have a defined value like ex $page = 1
    {
        return $this->render('AppBundle:Blog:list.html.twig', array(
            // ...
        ));
    }

//  has to commented to enable all url suffix
    /**
     * Matches /blog/*
     *
     * @Route ("/blog/{slug}", name="blog_show")
     */
    public function showAction($slug)
    {
        /**
         * matches "/blog/my-blog-post
         */
//        $url = $this->generateUrl(
//            'blog_show',
//            array('slug' => 'my-blog-post')
//        );

        return $this->render('AppBundle:Blog:list.html.twig', array(
        ));
    }

    /**
     * @Route (
     *     "/articles/{_locale}/{year}/{slug}.{_format}",
     *     defaults={"_format": "html"},
     *     requirements={
     *         "_locale": "en|fr",
     *         "_format": "html|rss",
     *         "year": "\d+"
     *      }
     * )
     */
    public function advancedShowAction($_locale, $year, $slug)
    {
        return $this->render('AppBundle:Blog:list.html.twig', array(
            // ...
        ));
    }
}
