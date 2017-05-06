<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Enfant;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Knp\Component\Pager\Paginator;

/**
 * Enfant controller.
 *
 */
class EnfantController extends Controller {

    /**
     * Lists all enfant entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $enfants = $em->getRepository('AdminAdminBundle:Enfant')->findBy(array('adh' => 1,));

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $enfants, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminAdminBundle:enfant:index.html.twig', array(
                    'enfants' => $pagination,
        ));
    }

    public function listnaAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $enfants = $em->getRepository('AdminAdminBundle:Enfant')->findBy(array('adh' => 0,));

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $enfants, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminAdminBundle:enfant:listna.html.twig', array(
                    'enfants' => $pagination,
        ));
    }

    /**
     * Creates a new enfant entity.
     *
     */
    public function newAction(Request $request) {
        $enfant = new Enfant();
        $form = $this->createForm('Admin\AdminBundle\Form\EnfantType', $enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($enfant);
            $em->flush($enfant);

            return $this->redirectToRoute('enfant_show', array('id' => $enfant->getId()));
        }

        return $this->render('AdminAdminBundle:enfant:new.html.twig', array(
                    'enfant' => $enfant,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a enfant entity.
     *
     */
    public function showAction(Enfant $enfant) {
        $personne = $this->getDoctrine()->getManager()->getRepository('AdminAdminBundle:Personne')->find($enfant->getId());
        $deleteForm = $this->createDeleteForm($enfant);

        return $this->render('AdminAdminBundle:Enfant:show.html.twig', array(
                    'personne' => $personne,
                    'enfant' => $enfant,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    public function adhAction(\Symfony\Component\HttpFoundation\Request $request) {
        $em = $this->getDoctrine()->getManager();

        $personne = $em->getRepository('AdminAdminBundle:Personne')->find($request->get('id'));
        $personne->setAdh(1);
        $em->persist($personne);
        $em->flush($personne);
        
        return $this->redirectToRoute('enfant_index');
    }

    /**
     * Displays a form to edit an existing enfant entity.
     *
     */
    public function editAction(Request $request, Enfant $enfant) {
        $deleteForm = $this->createDeleteForm($enfant);
        $editForm = $this->createForm('Admin\AdminBundle\Form\EnfantType', $enfant);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('enfant_edit', array('id' => $enfant->getId()));
        }

        return $this->render('AdminAdminBundle:enfant:edit.html.twig', array(
                    'enfant' => $enfant,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a enfant entity.
     *
     */
    public function deleteAction(Request $request, Enfant $enfant) {
        $form = $this->createDeleteForm($enfant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($enfant);
            $em->flush($enfant);
        }

        return $this->redirectToRoute('enfant_index');
    }

    /**
     * Creates a form to delete a enfant entity.
     *
     * @param Enfant $enfant The enfant entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Enfant $enfant) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('enfant_delete', array('id' => $enfant->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
