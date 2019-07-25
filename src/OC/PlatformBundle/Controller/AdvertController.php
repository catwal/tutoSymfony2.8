<?php

namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class AdvertController extends Controller
{
    public function indexAction()
    {

//  return new Response("Hello-World in page index");
//      $content = $this->get('templating')->render('OCPlatformBundle:Advert:index.html.twig');
//        return new Response($content);

        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            [
                'name' => 'you !',
            ]
        );
    }

    /**
     * @param $id
     *
     * @return Response
     */
//    public function viewAction($id)
//    {
//        return new Response("print id from url /platform/advert/: " . $id);
//    }


    public function viewAction()
    {
        $url = $this->get('router')->generate(
            'oc_platform_view',
            ['id' => 5],
//            constraint to absolute url
            true
        );
        // same method shorter
        $url = $this->generateUrl('oc_platform_view', array('id'=>5));

        return new Response("url of this template ended by /platform/advert/5: " . $url);
    }

    public function viewSlugAction($slug, $year, $format)
    {
        return new Response(
            "On pourrait afficher l'annonce correspondant au
            slug '" . $slug . "', créée en " . $year . " et au format " . $format . "."
        );
    }

}
