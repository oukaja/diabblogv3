<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Recherche;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Recherche controller.
 *
 */
class RechercheController extends Controller
{
    /**
     * Lists all recherche entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $recherches = $em->getRepository('AdminAdminBundle:Recherche')->findAll();

        return $this->render('recherche/index.html.twig', array(
            'recherches' => $recherches,
        ));
    }

    /**
     * Creates a new recherche entity.
     *
     */
    public function newAction(Request $request)
    {
        $recherche = new Recherche();
        $form = $this->createForm('Admin\AdminBundle\Form\RechercheType', $recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recherche);
            $em->flush();

            return $this->redirectToRoute('recherche_show', array('id' => $recherche->getId()));
        }

        return $this->render('recherche/new.html.twig', array(
            'recherche' => $recherche,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a recherche entity.
     *
     */
    public function showAction(Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);

        return $this->render('recherche/show.html.twig', array(
            'recherche' => $recherche,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing recherche entity.
     *
     */
    public function editAction(Request $request, Recherche $recherche)
    {
        $deleteForm = $this->createDeleteForm($recherche);
        $editForm = $this->createForm('Admin\AdminBundle\Form\RechercheType', $recherche);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('recherche_edit', array('id' => $recherche->getId()));
        }

        return $this->render('recherche/edit.html.twig', array(
            'recherche' => $recherche,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a recherche entity.
     *
     */
    public function deleteAction(Request $request, Recherche $recherche)
    {
        $form = $this->createDeleteForm($recherche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($recherche);
            $em->flush();
        }

        return $this->redirectToRoute('recherche_index');
    }

    /**
     * Creates a form to delete a recherche entity.
     *
     * @param Recherche $recherche The recherche entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Recherche $recherche)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('recherche_delete', array('id' => $recherche->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
