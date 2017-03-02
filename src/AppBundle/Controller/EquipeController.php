<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request; 

use AppBundle\Entity\Equipe;

class EquipeController extends Controller
{
    /**
     * @Route("/equipe", name="equipe")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $roles = $em->getRepository('AppBundle:Role')->findAll();

        //Conto il numero totale di ruoli
        $roles_num = count($roles);

        //Inizializzo una variabile per contenere il numero maggiore di 
        //equipe in un ruolo
        $max_people = 0;

        for($i=0; $i<$roles_num; $i++){
            $num = count($roles[$i]->getEquipes());
            if($num > $max_people)
                $max_people = $num;
        }

        $equipe = $em->getRepository('AppBundle:Equipe')->getByName();

        return $this->render('AppBundle:Equipe:index.html.twig', array(
            'roles' => $roles,
            'max_people' => $max_people,
            'equipe' => $equipe
        ));
    }

    /**
     * @Route("/admin/equipe", name="admin_equipe_index")
     */
    public function indexAdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $equipe = $em->getRepository('AppBundle:Equipe')->findAll();

        return $this->render('equipe/index.html.twig', array(
            'equipe' => $equipe
        ));
    }

    /**
     * Creates a new equipe entity.
     *
     * @Route("/admin/equipe/new", name="admin_equipe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $equipe = new Equipe();
        $form = $this->createForm('AppBundle\Form\EquipeType', $equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($equipe);
            $em->flush($equipe);

            return $this->redirectToRoute('admin_equipe_show', array('id' => $equipe->getId()));
        }

        return $this->render('equipe/new.html.twig', array(
            'equipe' => $equipe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a equipe entity.
     *
     * @Route("/admin/equipe/{id}", name="admin_equipe_show")
     * @Method("GET")
     */
    public function showAdminAction(Equipe $equipe)
    {
        $deleteForm = $this->createDeleteForm($equipe);

        return $this->render('equipe/show.html.twig', array(
            'equipe' => $equipe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing equipe entity.
     *
     * @Route("/admin/equipe/{id}/edit", name="admin_equipe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Equipe $equipe)
    {
        $deleteForm = $this->createDeleteForm($equipe);
        $editForm = $this->createForm('AppBundle\Form\EquipeType', $equipe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_equipe_edit', array('id' => $equipe->getId()));
        }

        return $this->render('equipe/edit.html.twig', array(
            'equipe' => $equipe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a equipe entity.
     *
     * @Route("/admin/equipe/{id}", name="admin_equipe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Equipe $equipe)
    {
        $form = $this->createDeleteForm($equipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($equipe);
            $em->flush($equipe);
        }

        return $this->redirectToRoute('admin_equipe_index');
    }

    /**
     * Creates a form to delete a equipe entity.
     *
     * @param Equipe $equipe The equipe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Equipe $equipe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_equipe_delete', array('id' => $equipe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

}
