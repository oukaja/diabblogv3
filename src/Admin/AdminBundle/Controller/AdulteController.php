<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Adulte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Paginator;

/**
 * Adulte controller.
 *
 */
class AdulteController extends Controller {

    /**
     * Lists all adulte entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $adultes = $em->getRepository('AdminAdminBundle:Adulte')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                 $adultes, /* query NOT result */
                $request->query->getInt('page', 1)/* page number */,
                10/* limit per page */
        );

        return $this->render('AdminAdminBundle:adulte:index.html.twig', array(
                    'adultes' => $pagination
        ));
    }

    /**
     * Creates a new adulte entity.
     *
     */
    public function newAction(Request $request) {
        $adulte = new Adulte();
        $form = $this->createForm('Admin\AdminBundle\Form\AdulteType', $adulte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($adulte);
            $em->flush($adulte);

            return $this->redirectToRoute('adulte_show', array('id' => $adulte->getId()));
        }

        return $this->render('AdminAdminBundle:adulte:new.html.twig', array(
                    'adulte' => $adulte,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a adulte entity.
     *
     */
    public function showAction(Adulte $adulte) {
        $personne = $this->getDoctrine()->getManager()->getRepository('AdminAdminBundle:Personne')->find($adulte->getId());
        $deleteForm = $this->createDeleteForm($adulte);

        return $this->render('AdminAdminBundle:adulte:show.html.twig', array(
                    'personne' => $personne,
                    'adulte' => $adulte,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing adulte entity.
     *
     */
    public function editAction(Request $request, Adulte $adulte) {
        $deleteForm = $this->createDeleteForm($adulte);
        $editForm = $this->createForm('Admin\AdminBundle\Form\AdulteType', $adulte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adulte_edit', array('id' => $adulte->getId()));
        }

        return $this->render('AdminAdminBundle:adulte:edit.html.twig', array(
                    'adulte' => $adulte,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a adulte entity.
     *
     */
    public function deleteAction(Request $request, Adulte $adulte) {
        $form = $this->createDeleteForm($adulte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($adulte);
            $em->flush($adulte);
        }

        return $this->redirectToRoute('adulte_index');
    }

    /**
     * Creates a form to delete a adulte entity.
     *
     * @param Adulte $adulte The adulte entity
     *
     * @return Form The form
     */
    private function createDeleteForm(Adulte $adulte) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('adulte_delete', array('id' => $adulte->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
