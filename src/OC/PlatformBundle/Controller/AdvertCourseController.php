<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AdvertCourseController extends Controller
{
    public function indexAction()
    {

//  return new Response("Hello-World in page index");
//      $content = $this->get('templating')->render('OCPlatformBundle:Advert:index.html.twig');
//        return new Response($content);

        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            array()
        );
    }

    /**
     * @param $id
     *
     * @return Response
     */
    // Request
    public function viewAction($id, Request $request)
    {
        // recovery of word tag in url (by request HTTP by $request) and print it into view
        // method: query, request, cookies, server, headers, attributes
        // method was recovery from a clic on a link with method GET or via a POST from form
        if ($request->isMethod('POST')) {
            //TODO
        };
        $tag = $request->query->get('tag');
        // construction of response object

//        $response = new Response();
//        $response->setContent("Ceci est une page d'erreur 404");
//        $response->setStatusCode(Response::HTTP_NOT_FOUND);
//
//        return $response;

//        return new Response(
//            "<html><body> print id from url /platform/advert/: " . $id . "and a tag : " . $tag . "</body></html>"
//        );

        if(!$tag){
            // redirection page
           // $url = $this->get('router')->generate('oc_platform_homepage');
            //return new RedirectResponse($url);
            return $this->redirectToRoute('oc_platform_homepage');
        }


        //Manipulation of session

        $session= $request->getSession();
        $userId = $session->get('user_id');
        $session->set('user_id', 91);

        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'bien enregistrée');
        $session->getFlashBag()->add('info', 'oui, c\'est bien enregistrée');
        dump($session);


        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            [
                'id'  => $id,
                'tag' => $tag,
            ]
        );
    }


//    public function viewAction()
//    {
//        $url = $this->get('router')->generate(
//            'oc_platform_view',
//            ['id' => 5],
////            constraint to absolute url
//            true
//        );
//        // same method shorter
//        $url = $this->generateUrl('oc_platform_view', array('id'=>5));
//
//        return new Response("url of this template ended by /platform/advert/5: " . $url);
//    }

    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '" . $slug . "', créée en " . $year . " et au format " . $format . "."
        );
    }

}
