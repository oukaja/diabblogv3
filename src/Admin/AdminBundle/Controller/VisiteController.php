<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Visite;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints\DateTime;
use \Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Visite controller.
 *
 */
class VisiteController extends Controller {

    /**
     * Lists all visite entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $visites = $em->getRepository('AdminAdminBundle:Visite')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $visites, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        return $this->render('AdminAdminBundle:visite:index.html.twig', array(
                    'visites' => $pagination,
        ));
    }

    public function listAction(Request $request) {
        $date = $request->get('dayl');
        $em = $this->getDoctrine()->getEntityManager();
        $builder = $em->createQueryBuilder();
        $result = $builder->select('a.id', 'a.datevisite', 'a.diab', 'a.tension', 'a.poid', 'a.remarque', 'c.nom' , 'c.ninscription')
                        ->from('AdminAdminBundle:Visite', 'a')
                        ->innerJoin('a.personne', 'c','a.personne = c.id')
                        //->innerJoin('a', 'personne', 'c', 'a.personne = c.id')
                        ->andWhere('a.datevisite > :date_start')
                        ->andWhere('a.datevisite < :date_end')
                        ->setParameter('date_start', new \DateTime($date . " 00:00:00"))
                        ->setParameter('date_end', new \DateTime($date . " 23:59:59"))
                        ->getQuery()->getResult();
        
       return $this->render('AdminAdminBundle:visite:list.html.twig', array(
                    'visites' => $result,
        ));
      
            }

    /**
     * Creates a new visite entity.
     *
     */
    public function newAction(Request $request) {
        $visite = new Visite();
        $form = $this->createForm('Admin\AdminBundle\Form\VisiteType', $visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visite);
            $em->flush($visite);

            return $this->redirectToRoute('visite_show', array('id' => $visite->getId()));
        }

        return $this->render('AdminAdminBundle:visite:new.html.twig', array(
                    'visite' => $visite,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a visite entity.
     *
     */
    public function showAction(Visite $visite) {
        $deleteForm = $this->createDeleteForm($visite);

        return $this->render('AdminAdminBundle:visite:show.html.twig', array(
                    'visite' => $visite,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing visite entity.
     *
     */
    public function editAction(Request $request, Visite $visite) {
        $deleteForm = $this->createDeleteForm($visite);
        $editForm = $this->createForm('Admin\AdminBundle\Form\VisiteType', $visite);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visite_edit', array('id' => $visite->getId()));
        }

        return $this->render('AdminAdminBundle:visite:edit.html.twig', array(
                    'visite' => $visite,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a visite entity.
     *
     */
    public function deleteAction(Request $request, Visite $visite) {
        $form = $this->createDeleteForm($visite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visite);
            $em->flush($visite);
        }

        return $this->redirectToRoute('visite_index');
    }

    /**
     * Creates a form to delete a visite entity.
     *
     * @param Visite $visite The visite entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Visite $visite) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('visite_delete', array('id' => $visite->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
