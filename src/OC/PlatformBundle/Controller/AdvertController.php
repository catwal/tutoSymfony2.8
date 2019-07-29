<?php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    /**
     * @param $page
     *
     * @return Response
     * @throws \Exception
     */
    public function indexAction($page)
    {
        if ($page < 1) {
            // if page is not existing
            throw new NotFoundHttpException('Page "' . $page . '" inexistante');
        }


        $listAdverts = [
            [
                'title'   => 'Recherche développpeur Symfony2',
                'id'      => 1,
                'author'  => 'Alexandre',
                'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
                'date'    => new \Datetime(),
            ],
            [
                'title'   => 'Mission de webmaster',
                'id'      => 2,
                'author'  => 'Hugo',
                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
                'date'    => new \Datetime(),
            ],
            [
                'title'   => 'Offre de stage webdesigner',
                'id'      => 3,
                'author'  => 'Mathieu',
                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
                'date'    => new \Datetime(),
            ],
        ];

        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            ['listAdverts' => $listAdverts]
        );
    }


    /**
     * @param $id
     *
     * @return Response
     * @throws \Exception
     */
    public function viewAction($id)
        // see announce
    {
        $advert = [
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime(),
        ];

        return $this->render(
            'OCPlatformBundle:Advert:view.html.twig',
            [
                'id'     => $id,
                'advert' => $advert,
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        //verif spam after sumbitting post
        $antispam = $this->container->get('oc_platform.antispam');
        $text='trial with less than 50 caracters';
        if($antispam->isSpam($text)){
            throw new \Exception('Votre message à été détecté comme spam');
        }

        // if request with HTTP POST it's because user had submit a form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            return $this->redirectToRoute('oc_platform_view', ['id' => 5]);
        }

        $id     = 5;
        $advert = [
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime(),
        ];

        return $this->render(
            'OCPlatformBundle:Advert:view.html.twig',
            [
                'advert' => $advert,
            ]
        );

        // if not POST display the form
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        // if POST, form have been submitted
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée');

            return $this->redirectToRoute('oc_platform_view', ['id' => 5]);
        }

        // refactoring
        $advert = [
            'title'   => 'Recherche développpeur Symfony2',
            'id'      => $id,
            'author'  => 'Alexandre',
            'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
            'date'    => new \Datetime(),
        ];

        // else display the form for modification
        return $this->render(
            'OCPlatformBundle:Advert:edit.html.twig',
            [
                'advert' => $advert,
            ]
        );
    }


    public function deleteAction($id)
    {
        // recovery of id and process of the delete
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }


    public function menuAction()
    {
        $listAdverts = [
            ['id' => 2, 'title' => 'Recherche développeur Symfony2'],
            ['id' => 5, 'title' => 'Mission webmaster'],
            ['id' => 9, 'title' => 'Offre de stage webdesigner'],
        ];

        return $this->render(
            'OCPlatformBundle:Advert:menu.html.twig',
            [
                'listAdverts' => $listAdverts,
            ]
        );
    }
}
