<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\Vendu;
use Admin\AdminBundle\Entity\Produit;
use Admin\AdminBundle\Repository\VenduRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vendu controller.
 *
 */
class VenduController extends Controller {

    /**
     * Lists all vendu entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $vendus = $em->getRepository('AdminAdminBundle:Vendu')->findAll();

         /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                 $vendus, /* query NOT result */
                $request->query->getInt('page', 1)/* page number */,
                10/* limit per page */
        );
        
        return $this->render('AdminAdminBundle:vendu:index.html.twig', array(
                    'vendus' => $pagination ,
        ));
    }

    /**
     * Creates a new vendu entity.
     *
     */
    public function newAction(Request $request) {
        $vendu = new Vendu();
        $form = $this->createForm('Admin\AdminBundle\Form\VenduType', $vendu);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $qv = $vendu->getQte();
            $qp = $vendu->getProduit()->getQte();
            if ($qp >= $qv) {
                $produit = $em->getRepository('AdminAdminBundle:Produit')->find($vendu->getProduit()->getId());
                $produit->setQte($qp - $qv);
                $em->persist($vendu);
                $em->flush($vendu);
                $em->flush($produit);
                return $this->redirectToRoute('vendu_show', array('id' => $vendu->getId()));
            } else {
                return new \Symfony\Component\HttpFoundation\Response("Qte invalide");
            }
        }
        return $this->render('AdminAdminBundle:vendu:new.html.twig', array(
                    'vendu' => $vendu,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vendu entity.
     *
     */
    public function showAction(Vendu $vendu) {
        $deleteForm = $this->createDeleteForm($vendu);

        return $this->render('AdminAdminBundle:vendu:show.html.twig', array(
                    'vendu' => $vendu,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vendu entity.
     *
     */
    public function editAction(Request $request, Vendu $vendu) {
        $deleteForm = $this->createDeleteForm($vendu);
        $editForm = $this->createForm('Admin\AdminBundle\Form\VenduType', $vendu);
        $qteVenduA = $editForm->get("qte")->getData();
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            $qteStock = $vendu->getProduit()->getQte();
            $qteVenduN = $vendu->getQte();
            if ($qteStock >= abs($qteVenduA - $qteVenduN)) {
                $this->getDoctrine()->getRepository('AdminAdminBundle:Produit')
                        ->find($vendu->getProduit()->getId())
                        ->setQte($qteStock - abs(abs($qteVenduA) - abs($qteVenduN)));
                $this->getDoctrine()->getManager()->persist($vendu->getProduit());
                $this->getDoctrine()->getManager()->flush($vendu->getProduit());

                return $this->redirectToRoute('vendu_edit', array('id' => $vendu->getId()));
            } else {
                return new \Symfony\Component\HttpFoundation\Response("Qte invalide");
            }
        }

        return $this->render('AdminAdminBundle:vendu:edit.html.twig', array(
                    'vendu' => $vendu,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vendu entity.
     *
     */
    public function deleteAction(Request $request, Vendu $vendu) {
          $form = $this->createDeleteForm($vendu);
        $form->handleRequest($request);
        $produit = $this->getDoctrine()->getRepository("AdminAdminBundle:Produit")
                ->find($vendu->getProduit()->getId());
        $produit->setQte($produit->getQte() + $vendu->getQte());
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $em->remove($vendu);

            $em->flush($vendu);
            $em->flush($produit);
        }

        return $this->redirectToRoute('vendu_index');
    }

    /**
     * Creates a form to delete a vendu entity.
     *
     * @param Vendu $vendu The vendu entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Vendu $vendu) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('vendu_delete', array('id' => $vendu->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
