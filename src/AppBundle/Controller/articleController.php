<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class articleController extends Controller

{
    /**
     * @Route ("/listArticles")
     */
    public function listArticlesAction()
    {
       $articles = array(
          'title'=> 'essai',
          'authorName' => 'roger',
          'body'=> 'Lettre ouverte à un inconnu'
       );
        return $this->render('AppBundle:article:list_articles.html.twig', array(
           'articles' => $articles,
        ));
    }

}
