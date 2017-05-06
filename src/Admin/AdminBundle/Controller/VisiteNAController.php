<?php

namespace Admin\AdminBundle\Controller;

use Admin\AdminBundle\Entity\VisiteNA;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Visitena controller.
 *
 */
class VisiteNAController extends Controller {

    public function listAction(Request $request) {
        $date = $request->get('dayl');
        $em = $this->getDoctrine()->getEntityManager();
        $builder = $em->createQueryBuilder();
        $result = $builder->select('a.id', 'a.datevisite', 'a.diab', 'a.tension', 'a.poid', 'a.remarque')
                        ->from('AdminAdminBundle:VisiteNA', 'a')
                        // ->innerJoin('a.personne', 'c','a.personne = c.id')
                        //->innerJoin('a', 'personne', 'c', 'a.personne = c.id')
                        ->andWhere('a.datevisite >= :date_start')
                        ->andWhere('a.datevisite <= :date_end')
                        ->setParameter('date_start', new \DateTime($date . " 00:00:00"))
                        ->setParameter('date_end', new \DateTime($date . " 23:59:59"))
                        ->getQuery()->getResult();
        //return new \Symfony\Component\HttpFoundation\JsonResponse($result);
        return $this->render('AdminAdminBundle:visitena:list.html.twig', array(
                    'visites' => $result,
        ));
    }

    /**
     * Lists all visiteNA entities.
     *
     */
    public function indexAction(Request $request) {
        $em = $this->getDoctrine()->getManager();

        $visiteNAs = $em->getRepository('AdminAdminBundle:VisiteNA')->findAll();

        /**
         * @var $paginator \Knp\Component\Pager\Paginator
         */
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $visiteNAs, /* query NOT result */ $request->query->getInt('page', 1)/* page number */, 10/* limit per page */
        );

        $data = $this->render('AdminAdminBundle:visitena:index.html.twig', array(
            'visiteNAs' => $pagination,
        ));

        return $data;
    }

    /**
     * Creates a new visiteNA entity.
     *
     */
    public function newAction(Request $request) {
        $visiteNA = new Visitena();
        $form = $this->createForm('Admin\AdminBundle\Form\VisiteNAType', $visiteNA);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($visiteNA);
            $em->flush($visiteNA);

            return $this->redirectToRoute('visitena_show', array('id' => $visiteNA->getId()));
        }

        return $this->render('AdminAdminBundle:visitena:new.html.twig', array(
                    'visiteNA' => $visiteNA,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a visiteNA entity.
     *
     */
    public function showAction(VisiteNA $visiteNA) {
        $deleteForm = $this->createDeleteForm($visiteNA);

        return $this->render('AdminAdminBundle:visitena:show.html.twig', array(
                    'visiteNA' => $visiteNA,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing visiteNA entity.
     *
     */
    public function editAction(Request $request, VisiteNA $visiteNA) {
        $deleteForm = $this->createDeleteForm($visiteNA);
        $editForm = $this->createForm('Admin\AdminBundle\Form\VisiteNAType', $visiteNA);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('visitena_edit', array('id' => $visiteNA->getId()));
        }

        return $this->render('AdminAdminBundle:visitena:edit.html.twig', array(
                    'visiteNA' => $visiteNA,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a visiteNA entity.
     *
     */
    public function deleteAction(Request $request, VisiteNA $visiteNA) {
        $form = $this->createDeleteForm($visiteNA);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($visiteNA);
            $em->flush($visiteNA);
        }

        return $this->redirectToRoute('visitena_index');
    }

    /**
     * Creates a form to delete a visiteNA entity.
     *
     * @param VisiteNA $visiteNA The visiteNA entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VisiteNA $visiteNA) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('visitena_delete', array('id' => $visiteNA->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

}
