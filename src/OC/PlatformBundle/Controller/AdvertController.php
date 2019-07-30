<?php


namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Image;
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
//        // récupération du repository
//        $repository = $this->getDoctrine()->getManager()->getRepository('OCPlatformBundle:Advert');
//        // recupération de l'objet entité avec cet id
//        $advert = $repository->find($id);
//        // si l'id ou advert n'exsite pas
//

        $em     = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if ($advert === null) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        //récupération des listes de candidature
        $listApplications = $em->getRepository('OCPlatformBundle:Application')->findBy(['advert' => $advert]);


        return $this->render(
            'OCPlatformBundle:Advert:view.html.twig',
            [
                'advert' => $advert,
                'listApplications'=>$listApplications
            ]
        );
    }

    /**
     * @param Request $request
     *
     * @return RedirectResponse|Response
     * @throws \Exception
     */
    public function addAction(Request $request)
    {
        //verif spam after sumbitting post
        $antispam = $this->container->get('oc_platform.antispam');
        $text     = 'trial with less than 50 caracters jkfsdgmeslkfjgmfghsdmkfghmfkghmfkghfmkgdhfmgkhdfgmkhdsfgmdshg
        sdfghsdmfgsdmflkgjdsmlfgjdsmlfgjdsmflkgjsdfmllljg';
        if ($antispam->isSpam($text)) {
            throw new \Exception('Votre message à été détecté comme spam');
        }

        // création de l'entité
        $advert = new Advert();
        $advert->setTitle('Recherche webdesigner');
        $advert->setAuthor('Monique');
        $advert->setContent('Nous recherchons sur lyon... ');

        // création entité image
        $image = new Image();
        $image->setUrl('http://sdz-upload.s3.amazonaws.com/prod/upload/job-de-reve.jpg');
        $image->setAlt('Job de rêve');

        //on lie l'image à l'annonce
        $advert->setImage($image);


        // création d'une première candidature
        $application1 = new Application();
        $application1->setAuthor('Marine');
        $application1->setContent('Super motivée');

        //création d'une seconde application
        $application2 = new Application();
        $application2->setAuthor('Pierre');
        $application2->setContent('compétences présentes');

        // lie candidature à l'annonce
        $application1->setAdvert($advert);
        $application2->setAdvert($advert);


        // récupération de l'entityManager
        $em = $this->getDoctrine()->getManager();

        // première étape: persiste les données
        $em->persist($advert);

        //persiste application
        $em->persist($application1);
        $em->persist($application2);

        // deuxième étape: on flush ce qui a été persisté
        $em->flush();


        // if request with HTTP POST it's because user had submit a form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            return $this->redirect($this->generateUrl('oc_platform_view', ['id' => $advert->getId()]));
        }


        return $this->render(
            'OCPlatformBundle:Advert:add.html.twig',
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
