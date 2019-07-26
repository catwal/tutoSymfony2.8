<?php


namespace OC\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    /**+
     * @param $page
     *
     * @return Response
     */
    public function indexAction($page)
    {
        if ($page < 1) {
            // if page is not existing
            throw new NotFoundHttpException('Page "' . $page . '" inexistante');
        }

        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            []
        );
    }

    /**
     * @param $id
     *
     * @return Response
     */
    public function viewAction($id)
        // see announce
    {
        return $this->render(
            'OCPlatformBundle:Advert:index.html.twig',
            [
                'id' => $id,
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
        // if request with HTTP POST it's because user had submit a form
        if ($request->isMethod('POST')) {
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée');

            return $this->redirectToRoute('oc_platform_view', ['id' => 5]);
        }

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

        // else display the form for modification
        return $this->render('OCPlatformBundle:Advert:edit.html.twig');
    }


    public function deleteAction($id)
    {
        // recovery of id and process of the delete
        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }
}
