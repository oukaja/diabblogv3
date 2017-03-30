<?php

namespace Admin\BlogBundle\Controller;

use Admin\BlogBundle\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Contact controller.
 *
 */
class ContactController extends Controller
{
    /**
     * Lists all contact entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AdminBlogBundle:Contact')->findAll();

        return $this->render('AdminBlogBundle:contact:index.html.twig', array(
            'contacts' => $contacts,
        ));
    }

    /**
     * Creates a new contact entity.
     *
     */
    public function newAction(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm('Admin\BlogBundle\Form\ContactType', $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $message = \Swift_Message::newInstance()
            ->setSubject($form->get('sujet')->getData())
            ->setFrom($form->get('email')->getData())
            ->setTo('oukaja.mehdi@gmail.com')
            ->setBody($form->get('message')->getData() . '\nFrom : ' . $form->get('name')->getData());
        $this->get('mailer')->send($message);

       // $this->get('session')->setFlash('blogger-notice', 'Your contact enquiry was successfully sent. Thank you!');
           // return new \Symfony\Component\HttpFoundation\Request("msg envoye",null);
        $em = $this->getDoctrine()->getManager();

        $contacts = $em->getRepository('AdminBlogBundle:Contact')->findAll();
        return $this->render('AdminBlogBundle:contact:index.html.twig', array(
            'contacts' => $contacts,
        ));
        }

        return $this->render('AdminBlogBundle:contact:new.html.twig', array(
            'contact' => $contact,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a contact entity.
     *
     */
    public function showAction(Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);

        return $this->render('AdminBlogBundle:contact:show.html.twig', array(
            'contact' => $contact,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing contact entity.
     *
     */
    public function editAction(Request $request, Contact $contact)
    {
        $deleteForm = $this->createDeleteForm($contact);
        $editForm = $this->createForm('Admin\BlogBundle\Form\ContactType', $contact);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('contact_edit', array('id' => $contact->getId()));
        }

        return $this->render('AdminBlogBundle:contact:edit.html.twig', array(
            'contact' => $contact,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a contact entity.
     *
     */
    public function deleteAction(Request $request, Contact $contact)
    {
        $form = $this->createDeleteForm($contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($contact);
            $em->flush();
        }

        return $this->redirectToRoute('contact_index');
    }

    /**
     * Creates a form to delete a contact entity.
     *
     * @param Contact $contact The contact entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Contact $contact)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contact_delete', array('id' => $contact->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
