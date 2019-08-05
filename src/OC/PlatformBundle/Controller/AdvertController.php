<?php


namespace OC\PlatformBundle\Controller;

use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\AdvertSkill;
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


        $em = $this->getDoctrine()->getManager();
        // $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->myFindAll();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->getAdverts();


//        $listAdverts = [
//            [
//                'title'   => 'Recherche développpeur Symfony2',
//                'id'      => 1,
//                'author'  => 'Alexandre',
//                'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
//                'date'    => new \Datetime(),
//            ],
//            [
//                'title'   => 'Mission de webmaster',
//                'id'      => 2,
//                'author'  => 'Hugo',
//                'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
//                'date'    => new \Datetime(),
//            ],
//            [
//                'title'   => 'Offre de stage webdesigner',
//                'id'      => 3,
//                'author'  => 'Mathieu',
//                'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
//                'date'    => new \Datetime(),
//            ],
//        ];
        dump($listAdverts);

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

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id " . $id . " n'existe pas.");
        }

        //récupération des listes de candidature
        $listApplications = $em->getRepository('OCPlatformBundle:Application')->findBy(['advert' => $advert]);

        dump($advert);
        //récupération liste des advertSkills Methode magique findByX
        $listAdvertSkills = $em->getRepository('OCPlatformBundle:AdvertSkill')->findByAdvert($advert);

        dump($listAdvertSkills);

        return $this->render(
            'OCPlatformBundle:Advert:view.html.twig',
            [
                'advert'           => $advert,
                'listApplications' => $listApplications,
                'listAdvertSkills' => $listAdvertSkills,
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
        /*      // récupération de l'entityManager
              $em = $this->getDoctrine()->getManager();
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

              $listSkills = $em->getRepository('OCPlatformBundle:Skill')->findAll();

              // Pour chaque compétence
              foreach ($listSkills as $skill) {
                  // On crée une nouvelle « relation entre 1 annonce et 1 compétence »
                  $advertSkill = new AdvertSkill();

                  // On la lie à l'annonce, qui est ici toujours la même
                  $advertSkill->setAdvert($advert);
                  // On la lie à la compétence, qui change ici dans la boucle foreach
                  $advertSkill->setSkill($skill);

                  // Arbitrairement, on dit que chaque compétence est requise au niveau 'Expert'
                  $advertSkill->setLevel('Expert');

                  // Et bien sûr, on persiste cette entité de relation, propriétaire des deux autres relations
                  $em->persist($advertSkill);
              }

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
        */


        // if request with HTTP POST it's because user had submit a form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('info', 'Annonce bien enregistrée');

            return $this->redirect($this->generateUrl('oc_platform_view', ['id' => 1]));
        }

        //test slug
        /*        $advert = new Advert();
                $advert->setTitle("Recherche développeur !");
                $advert->setAuthor('Marine');
                $advert->setContent("Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…");

                $em = $this->getDoctrine()->getManager();
                $em->persist($advert);
                $em->flush(); // C'est à ce moment qu'est généré le slug

                return new Response('Slug généré : '.$advert->getSlug());
                // Affiche « Slug généré : recherche-developpeur »


                return $this->render(
                    'OCPlatformBundle:Advert:add.html.twig',
                    [
                        'advert' => $advert,
                    ]
                );
        */

        // if not POST display the form
        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction($id, Request $request)
    {
        /*    // récupération de toutes les catégories
            $listCategories = $em->getRepository('OCPlatformBundle:Category')->findAll();

            //boucle sur catégories pour les liées à l'annonce
            foreach ($listCategories as $category) {
                $advert->addCategory($category);
            }

        //déclenche enregistrement
        $em->flush();
            */

        $em     = $this->getDoctrine()->getManager();
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);
        if ($advert === null) {
            throw new createNotFoundException("L'annonce d'id " . $id . " n'existe pas.");
        }


        // if POST, form have been submitted
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée');

            return $this->redirectToRoute('oc_platform_view', ['advert' => $advert]);
        }


        // else display the form for modification
        return $this->render(
            'OCPlatformBundle:Advert:edit.html.twig',
            [
                'advert' => $advert,
            ]
        );
    }


    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //récupère l'annonce
        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);


        if (null === $advert) {
            throw new createNotFoundException("L'annonce d'id " . $id . " n'existe pas.");
        }


        // On boucle sur les catégories de l'annonce pour les supprimer
        foreach ($advert->getCategories() as $category) {
            $advert->removeCategory($category);
        }
        // Pour persister le changement dans la relation, il faut persister l'entité propriétaire
        // Ici, Advert est le propriétaire, donc inutile de la persister car on l'a récupérée depuis Doctrine

        // On déclenche la modification
        $em->flush();

        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('info', 'Annonce bien supprimée');

            return $this->redirect($this->generateUrl('oc_platform_homepage'));
        }


        // recovery of id and process of the delete
        return $this->render('OCPlatformBundle:Advert:delete.html.twig', ['advert' => $advert]);
    }


    public function menuAction()
    {
        $em          = $this->getDoctrine()->getManager();
        $listAdverts = $em->getRepository('OCPlatformBundle:Advert')->findWithLimit();


        return $this->render(
            'OCPlatformBundle:Advert:menu.html.twig',
            [
                'listAdverts' => $listAdverts,
            ]
        );
    }


    public function testAction()
    {
        $repository = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('OCPlatformBundle:Advert');

        $listAdvert = $repository->myFindAll();
        //...
    }
}
